<template>
  <div class="loading-wrapper" :class="{active: isActive}">
    <div class="spinner"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isActive: true,
    }
  },
  mounted() {
    if (window.matchMedia('(min-width: 940px)').matches) { // Only on desktop
        setTimeout(() => {
          /* Loading Spinner */
          this.isActive = false; // Stop the spinner
          /* Hero Section */
          $emit('activate-hero'); // Make the hero active
          // $('section.hero').removeClass('inactive'); 
        }, 600); // After 600 milliseconds
      } else {
          this.isActive = false;
      }
  }
}
</script>
