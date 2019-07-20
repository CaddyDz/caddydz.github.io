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
    if (window.matchMedia("(min-width: 940px)").matches) {
      window.addEventListener("scroll", () => {
        if (
          window.scrollY > 350 &&
          !(window.scrollY + window.innerHeight === document.body.clientHeight)
        ) {
          this.isVisible = true;
        } else {
          this.isVisible = false;
        }
      });
    }
  }
};
</script>
