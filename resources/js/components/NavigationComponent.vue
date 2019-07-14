<template>
    <!-- Header -->
    <header class="app-header" id="app-header">
        <div class="container">
            <div class="header-wrapper">
                <!-- Logo -->
                <div class="logo" id="logo">
                    <!-- image logo -->
                    <a href="/" class="image-logo">
                    <img src="/img/logo.jpg" :alt="app.name" style="display:inline"/> 
                    {{ app.name }}
                </a>
                    <!-- HTML logo -->
                    <a href="/" class="html-logo"><i class="fa fa-code"></i> {{ app.name }}</a>
                </div>
                <!-- Main-Nav -->
                <nav class="main-nav">
                    <ul>
                        <li :class="{ active: currentUrl === 'about' }">
                            <a href="/about">{{ $t('About') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'contact' }">
                            <a href="/contact">{{ $t('Contact') }}</a>
                        </li>
                    </ul>
                    <div class="icon-round-lrg-plain search-toggle">
                        <i class="fa fa-search"></i>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<i18n>
{
    "en": {
        "Contact": "Contact",
        "About": "About"
    },
    "fr": {
        "Contact": "Contact",
        "About": "À Propos"
    },
    "ar": {
        "Contact": "إتصل بالمبيعات",
        "About": "حول"
    }
}
</i18n>

<script>
export default {
  data() {
    return {
      app: {
        name: 'Caddy DZ'
      }
    }
  },
  computed: {
      currentUrl: function() {
          return document.location.pathname.slice(1);
      }
  },
  mounted() {
    axios.get('/api/getNavData')
         .then(response => {
           this.app.name = response.data.app.name
         });
  }
}
</script>

<style scoped>

</style>
