<template>
  <!-- Trigger sidebar for mobile -->
  <span class="icon-lrg nav-trigger flyout-trigger" id="flyout-trigger" :style="{top: top + 'em'}">
    <i class="fa fa-bars"></i>
  </span>
</template>

<script>
export default {
  data() {
    return {
      top: 0.7,
    };
  },
  mounted() {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 350) {
        this.top = 1.5;
      } else {
        this.top = 0.7;
      }
    });
  }
};
</script>
