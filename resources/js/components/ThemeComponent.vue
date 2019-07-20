<template>
  <div class="theme-options" :class="{active: isActive}">
      <i class="fa fa-cog options-trigger hover-bg-brand-1 brand-1-active" @click="isActive = !isActive" :class="{active: isActive}">
      </i>
      <div class="options-content">
          <h3>{{ $t('View Options') }}</h3>
          <section class="theme-option">
              <h4>{{ $t('Fixed Header') }}</h4>
              <p>{{ $t('Toggle to enable the fixed header.') }}</p>
              <div class="input-toggle">
                <input type="checkbox" id="fixed-header-toggle" name="fixed-header-toggle" v-model="fixedHeader"/>
                <label for="fixed-header-toggle"></label>
              </div>
          </section>
          <section class="theme-option">
              <h4>{{ $t('HTML Logo') }}</h4>
              <p>{{ $t('Toggle to enable HTML logo instead of image.') }}</p>
              <div class="input-toggle">
                <input type="checkbox" id="html-logo" name="html-logo" checked v-model="htmlLogo"/>
                <label for="html-logo"></label>
              </div>
          </section>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fixedHeader: '',
      htmlLogo: '',
      isActive: false
    }
  },
  watch: {
    fixedHeader: function () {
      localStorage.setItem('is-header-fixed', this.fixedHeader);
      const body = document.body;
      if (this.fixedHeader) {
        body.classList.add('fixed-header');
      } else {
        body.classList.remove('fixed-header');
      }
    },
    htmlLogo: function () {
      localStorage.setItem('is-logo-html', this.htmlLogo);
      this.$root.$emit('set-logo', this.htmlLogo);
    },
  },
  mounted() {
    /* Remember options */
    // Note that default value on first load is null
    this.fixedHeader = localStorage.getItem('is-header-fixed') === "true" ? true : false;
    this.htmlLogo = localStorage.getItem('is-logo-html') === "true" ? true : false;
  }
}
</script>

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
