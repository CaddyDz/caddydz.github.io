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
    this.$root.$on('scrolled-enough', () => {
      this.isVisible = true;
      document.body.classList.add('fh-visible');
    });
    this.$root.$on('not-scrolled-enough', () => {
      this.isVisible = false;
      document.body.classList.remove('fh-visible');
    });
  }
}
</script>
