<template>
  <a class="icon-lrg-border scroll-top" href="#site-content" v-show="isVisible">
    <i class="fa fa-angle-up"></i>
  </a>
</template>

<script>
export default {
  data() {
    return {
      isVisible: false
    };
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
};
</script>
