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
    this.$root.$on('scrolled-enough', () => {
      this.top = 1.5;
    });
    this.$root.$on('not-scrolled-enough', () => {
      this.top = 0.7;
    });
  }
};
</script>
