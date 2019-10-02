<template>
  <div class="icon-lrg nav-trigger cp-trigger" id="cp-trigger" v-show="isVisible" @click="toggleCP">
    <i class="fa fa-bars"></i>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isVisible: false,
      cpActive: false,
    }
  },
  methods: {
    toggleCP() {
      if (!this.cpActive) { // If control panel is inactive, (initial state) then activate it
        var scaleFactorWhenNavActive = 0.65; // change us if CSS body.cp-active #site-content transform:scale factor ever changes!

        var vPos = $('html').scrollTop(); // current scroll position in px

        // webkit doesn't consider the html container to have scrolled, so let's check the body container instead
        if (vPos == 0) vPos = $('body').scrollTop();

        var screenHeight = $(window).height();
        var screenHeightFactor = screenHeight * 0.15; // this is the height of the body:before, which is a height of 15%

        $('body').toggleClass('cp-active');
        $('.cp-trigger').toggleClass('nav-trigger-animate');
        $('body,html').animate({scrollTop:Number((vPos * scaleFactorWhenNavActive) - (screenHeightFactor))},0);
        // Declare Control Panel as active
        this.cpActive = true;
        // Emit global event
        this.$root.$emit('cp-active');
      } else { // If the control panel is active, then deactivate it
        $('body').toggleClass('cp-active');
        $('.cp-trigger').toggleClass('nav-trigger-animate');
        $('body,html').animate({
          scrollTop: Number((vPos + screenHeightFactor) / scaleFactorWhenNavActive) + 1
        }, 0);
        this.cpActive = false;
        this.$root.$emit('cp-inactive');
      }
    }
  },
  mounted() {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 350) {
        this.isVisible = true;
        document.body.classList.add('fh-visible');
      } else {
        if (!this.cpActive) { // Do not hide the trigger if the control panel is active
          this.isVisible = false;
        }
        document.body.classList.remove('fh-visible');
      }
    });
  }
}
</script>
