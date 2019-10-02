/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueI18n from 'vue-i18n'
const i18n = new VueI18n({
    locale: document.documentElement.lang
});
const app = new Vue({
    el: '#app',
    i18n,
    data() {
        return {
            isScreenLargeEnough: false,
            isHtml: false,
        }
    },
    created() {
        // Initialize the data depending on the initial screen size
        this.isScreenLargeEnough = window.matchMedia('(min-width: 940px)').matches;
    },
    mounted() {
        this.$root.$on('set-logo', isHtml => {
            this.isHtml = isHtml;
        });
        if (this.isScreenLargeEnough) {
            /******************************************************************
                Add Active Class
            ******************************************************************/
            let tiles = document.getElementsByClassName('inactive');
            window.addEventListener('scroll', () => {
                let windowHeight = window.scrollY + window.innerHeight;
                for (let tile of tiles) {
                    let height = tile.offsetTop + tile.offsetHeight;
                    if (height < windowHeight) {
                        tile.classList.remove('inactive');
                        tile.classList.add('active');
                    }
                }
            });
        } else {
            let tiles = document.getElementsByClassName('inactive');
            // On mobile devices, activate all tiles
            for (let tile of tiles) {
                tile.classList.remove('inactive');
            }
        }
        /******************************************************************
        Progress Bars
        ******************************************************************/

        let progressBars = document.getElementsByClassName('progress');
        for (let progressBar of progressBars) {
            let progress = progressBar.getAttribute('data-progress');
            progressBar.style.width = progress;
        }
    }
});
