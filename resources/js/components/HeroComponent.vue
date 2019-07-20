<template>
  <section class="hero" :class="{inactive: isInactive}">
    <div class="hero-down">
      <a href="#s-welcome" class="mouse" :style="{opacity:opacity}">
        <div class="mouse-animations">
          <div class="mouse-scroll-l"></div>
          <div class="mouse-scroll-2"></div>
          <div class="mouse-scroll-3"></div>
        </div>
      </a>
    </div>
    <div class="container">
      <div class="title-wrapper" :style="{transform:transform,opacity:opacity}">
        <div class="hero-title" v-html="heroData.title"></div>
        <div class="meta">
          <p class="blurb" v-html="heroData.content"></p>
          <a
            href="/contact"
            target="blank"
            class="button round brand-1"
          >{{ $t('contact') }}</a>
          <a href="#s-welcome" class="button round border">{{ $t('read') }}</a>
        </div>
      </div>
    </div>
  </section>
</template>

<i18n>
{
  "en": {
    "contact": "Contact Sales",
    "read": "Read More"
  },
  "fr": {
    "contact": "Contact commercial",
    "read": "En savoir plus"
  },
  "ar": {
    "contact": "إتصل بالمبيعات",
    "read": "قراءة المزيد"
  }
}
</i18n>

<style scoped>
</style>

<script>
export default {
  data() {
    return {
      heroData: {},
      isInactive: true,
      transform: '',
      opacity: 1
    }
  },
  mounted() {
    this.$root.$on('activate-hero', () => {
        this.isInactive = false;
    });
    axios('/api/getHeroData').then(response => {
          this.heroData = response.data;
        });
    if (window.matchMedia('(min-width: 940px)').matches) {
      window.addEventListener('scroll', () => {
        this.transform = "translate3d(0px, "+(window.scrollY/2.5)+"px, 0px)";
        this.opacity = 1 - window.scrollY / 700;
      });
    }
  },
};
</script>
