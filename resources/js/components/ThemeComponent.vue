<template>
  <div class="theme-options">
      <i class="fa fa-cog options-trigger hover-bg-brand-1 brand-1-active"></i>
      <div class="options-content">
          <h3>{{ $t('View Options') }}</h3>
          <section class="theme-option">
              <h4>{{ $t('Fixed Header') }}</h4>
              <p>{{ $t('Toggle to enable the fixed header.') }}</p>
              <div class="input-toggle">
                  <input type="checkbox" id="fixed-header-toggle" name="fixed-header-toggle" @change="toggleFixedHeader"/>
                  <label for="fixed-header-toggle"></label>
              </div>
          </section>
          <section class="theme-option">
              <h4>{{ $t('HTML Logo') }}</h4>
              <p>{{ $t('Toggle to enable HTML logo instead of image.') }}</p>
              <div class="input-toggle">
                  <input type="checkbox" id="html-logo" name="html-logo" checked />
                  <label for="html-logo"></label>
              </div>
          </section>
      </div>
  </div>
</template>

<i18n>
{
    "en": {
        "View Options": "View Options",
        "Fixed Header": "Fixed Header",
        "Toggle to enable the fixed header.": "Toggle to enable the fixed header.",
        "HTML Logo": "HTML Logo",
        "Toggle to enable HTML logo instead of image.": "Toggle to enable HTML logo instead of image."
    },
    "fr": {
        "View Options": "View Options",
        "Fixed Header": "Fixed Header",
        "Toggle to enable the fixed header.": "Toggle to enable the fixed header.",
        "HTML Logo": "HTML Logo",
        "Toggle to enable HTML logo instead of image.": "Toggle to enable HTML logo instead of image."
    },
    "ar": {
        "View Options": "View Options",
        "Fixed Header": "Fixed Header",
        "Toggle to enable the fixed header.": "Toggle to enable the fixed header.",
        "HTML Logo": "HTML Logo",
        "Toggle to enable HTML logo instead of image.": "Toggle to enable HTML logo instead of image."
    }
}
</i18n>

<script>
export default {
  data() {
    return {
      fixedHeader: false,
    }
  },
  methods: {
    toggleFixedHeader() {
      this.fixedHeader = !this.fixedHeader;
      const el = document.body;
      if (this.fixedHeader) {
        el.classList.add('fixed-header');
      } else {
        el.classList.remove('fixed-header');
      }
    }
  }
}
</script>
