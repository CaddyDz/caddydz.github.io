<template>
    <!-- Header -->
    <header class="app-header" :id="idProp">
        <div class="container">
            <div class="header-wrapper">
                <!-- Logo -->
                <div class="logo" id="logo">
                    <!-- image logo -->
                    <a href="/" class="image-logo" v-show="!isHtml">
                    <img src="/img/logo.jpg" :alt="app.name" style="display:inline"/>
                    {{ app.name }}
                </a>
                    <!-- HTML logo -->
                    <a href="/" class="html-logo" v-show="isHtml"><i class="fa fa-code"></i> {{ app.name }}</a>
                </div>
                <!-- Main-Nav -->
                <nav class="main-nav">
                    <ul>
                        <li :class="{ active: currentUrl === '' }">
                            <a href="/">{{ $t('Home') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'about' }">
                            <a href="/about">{{ $t('About') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'services' }">
                            <a href="/services">{{ $t('Services') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'portfolio' }">
                            <a href="/portfolio">{{ $t('Portfolio') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'blog' }">
                            <a href="/blog">{{ $t('Blog') }}</a>
                        </li>
                        <li :class="{ active: currentUrl === 'contact' }">
                            <a href="/contact">{{ $t('Contact') }}</a>
                        </li>
                    </ul>
                    <div class="icon-round-lrg-plain search-toggle" @click="activateSearch">
                        <i class="fa fa-search"></i>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
export default {
  props: ['id-prop'],
  data() {
    return {
      app: {
        name: 'Caddy DZ'
      },
      isHtml: false,
    }
  },
  computed: {
    currentUrl: function() {
        return document.location.pathname.slice(1);
    }
  },
  methods: {
      activateSearch() {
          document.body.classList.add('search-active'); // search box is visible
        // auto-focus the input afer transition complete
        setTimeout(() => {
            this.$root.$emit('focus-search-input');
        }, 400)
      }
  },
  mounted() {
    this.$root.$on('set-logo', isHtml => {
      this.isHtml = isHtml;
    });
    axios.get('/api/getNavData')
         .then(response => {
           this.app.name = response.data.app.name
         });
  }
}
</script>

<i18n>
{
    "en": {
        "Home": "Home",
        "About": "About",
        "Services": "Services",
        "Portfolio": "Portfolio",
        "Blog": "Blog",
        "Contact": "Contact"
    },
    "fr": {
        "Home": "Acceuil",
        "About": "À Propos",
        "Services": "Services",
        "Portfolio": "Portfolio",
        "Blog": "Blog",
        "Contact": "Contact"
    },
    "ar": {
        "Home": "الصفحة الرئيسية",
        "About": "حول",
        "Services": "الخدمات",
        "Portfolio": "Portfolio",
        "Blog": "المدونة",
        "Contact": "إتصل بالمبيعات"
    }
}
</i18n>
