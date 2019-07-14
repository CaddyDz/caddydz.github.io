<template>
  <section class="hero" :class="{inactive: isInactive}">
    <div class="hero-down">
      <a href="#s-welcome" class="mouse">
        <div class="mouse-animations">
          <div class="mouse-scroll-l"></div>
          <div class="mouse-scroll-2"></div>
          <div class="mouse-scroll-3"></div>
        </div>
      </a>
    </div>
    <div class="container">
      <div class="title-wrapper">
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
    }
  },
  mounted() {
    axios('/api/getHeroData').then(response => {
          this.heroData = response.data;
        });
  },
};
</script>
