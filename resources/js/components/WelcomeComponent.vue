<template>
  <section class="section primary welcome inactive" id="s-welcome">
    <div class="container">
        <div class="welcome-titles">
            <header class="welcome-content">
                <div class="section-title">
                    <h2>{{ $t('This is') }}&ThinSpace;<b>{{ $t('Web Development') }}</b></h2>
                    <h3>{{ $t('Welcome To the New Experience') }}</h3>
                </div>
                <p>
                    {{ $t('Cutting bleeding edge design and performance with') }}<a href="https://laravel.com"> Laravel</a>
                    {{ $t('in the backend') }}, <a href="https://vuejs.org">VueJS</a> {{ $t('in the frontend and much more behind the scenes') }}.
                </p>
            </header>
            <header class="welcome-content">
                <div class="section-title">
                    <h2><b>{{ $t('Responsive') }}</b> {{ $t('Design') }}</h2>
                    <h3>{{ $t('Builds For All Browsers & Devices') }}</h3>
                </div>
                <p class="welcome-browsers">
                    <i v-for="(browser, code) in browserIcons" :key="browser" class="livicon tooltip" :data-tip="browser" :data-n="code" data-c="original" :data-s="browserIconSize" data-hc="false"></i>
                </p>
            </header>
            <header class="welcome-content welcome-features">
                <div class="section-title">
                    <h2>
                      {{ $t('Our') }}&ThinSpace;<i>{{ $t('Services') }}</i> {{ $t('Are') }}
                      <strong>{{ $t('World Class') }}<i class="fa fa-trophy"></i></strong>
                    </h2>
                </div>
                <div class="welcome-features-carousel owl-carousel">
                    <div class="widget welcome-feature">
                        <i class="livicon" data-n="tablet" data-c="#C1C1C1" data-op="1" data-s="68" data-hc="false"></i>
                        <div class="widget-content">
                            <div class="title">
                                <h4>{{ $t('Retina Ready') }}</h4>
                            </div>
                            <p>{{ $t('retina') }}</p>
                        </div>
                    </div>
                    <div class="widget welcome-feature">
                        <i class="livicon" data-n="html5" data-c="#C1C1C1" data-op="1" data-s="68" data-hc="false"></i>
                        <div class="widget-content">
                            <div class="title">
                                <h4>{{ $t('Valid HTML5') }}</h4>
                            </div>
                            <p>{{ $t('html5') }}</p>
                        </div>
                    </div>
                    <div class="widget welcome-feature">
                        <i class="livicon" data-n="responsive" data-c="#C1C1C1" data-op="1" data-s="68"
                            data-hc="false"></i>
                        <div class="widget-content">
                            <div class="title">
                                <h4><span>100%</span> {{ $t('Responsive') }}</h4>
                            </div>
                            <p>{{ $t('responsive') }}</p>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="earth">
            <img src="/assets/images/earth.png" alt="Earth Image" />
            <div class="pins">
                <div class="pin-wrapper active">
                    <div class='pin'></div>
                </div>
                <div class="pin-wrapper">
                    <div class='pin'></div>
                </div>
                <div class="pin-wrapper">
                    <div class='pin'></div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-carousel">
        <div class="icon-round-border-lrg nav-prev">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="icon-round-border-lrg nav-next">
            <i class="fa fa-angle-right"></i>
        </div>
    </div>
</section>
</template>

<script>
export default {
    data() {
        return {
            browserIcons: {
                'ie': 'Internet Explorer',
                'firefox': 'Firefox',
                'chrome': 'Chrome',
                'opera': 'Opera',
                'safari': 'Safari'
            },
            browserIconSize: 48
        }
    },
    created() {
        if (this.$root.isScreenLargeEnough) {
            this.browserIconSize = 68;
        }
    }
}
</script>

<i18n>
{
  "en": {
    "This is": "This is",
    "Web Development": "Web Development",
    "Welcome To the New Experience": "Welcome To the New Experience",
    "Cutting bleeding edge design and performance with": "Cutting bleeding edge design and performance with",
    "in the backend": "in the backend",
    "in the frontend and much more behind the scenes": "in the frontend and much more behind the scenes",
    "Responsive": "Responsive",
    "Design": "Design",
    "Builds For All Browsers & Devices": "Builds For All Browsers & Devices",
    "Our": "Our",
    "Services": "Services",
    "Are": "Are",
    "World Class": "World Class",
    "Retina Ready": "Retina Ready",
    "retina": "Retina display devices show more pixels per square inch to allow for a crisper display and in order not to let the resulting display appear too small elements are mapped to 2 pixels instead of one (for retina2) (otherwise they would be tiny)",
    "Valid HTML5": "Valid HTML5",
    "html5": "In more length: the term \"HTML5\" is widely used as a buzzword to refer to modern Web technologies, many of which (though by no means all) are developed at the WHATWG. This document is one such; others are available from the WHATWG specification index.",
    "responsive": "Responsive design is an approach to web page creation that makes use of flexible layouts, flexible images and cascading style sheet media queries. The goal of responsive design is to build web pages that detect the visitor's screen size and orientation and change the layout accordingly."
  }
}
</i18n>
