<template>
  <!-- Sub-Header -->
  <section class="hero sub-header">
    <div class="container" :class="{inactive: isInactive}">
      <div class="sh-title-wrapper" :style="{transform:transform,opacity:opacity}">
        <h1>{{ title }}</h1>
        <p>{{ description }}</p>
        <a :href="url" target="blank" class="button border round cta">{{ link }}</a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ['title', 'description', 'url', 'link'],
  data() {
    return {
      isInactive: true,
      transform: '',
      opacity: 1
    }
  },
  mounted() {
    this.$root.$on('activate-hero', () => {
      this.isInactive = false;
    });
    this.$root.$on('scrolling', () => {
      this.transform = "translate3d(0px, "+(window.scrollY/3)+"px, 0px)";
      this.opacity = 1 - window.scrollY / 250;
    });
  }
}
</script>
