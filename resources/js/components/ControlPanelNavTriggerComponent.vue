<template>
  <div class="icon-lrg nav-trigger cp-trigger" id="cp-trigger" v-show="isVisible">
    <i class="fa fa-bars"></i>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isVisible: false,
    }
  },
  mounted() {
    if (window.matchMedia("(min-width: 940px)").matches) {
      window.addEventListener("scroll", () => {
        if (
          window.scrollY > 350 &&
          !(window.scrollY + window.innerHeight === document.body.clientHeight)
        ) {
          this.isVisible = true;
          document.body.classList.add('fh-visible');
        } else {
          this.isVisible = false;
          document.body.classList.remove('fh-visible');
        }
      });
    }
  }
}
</script>
