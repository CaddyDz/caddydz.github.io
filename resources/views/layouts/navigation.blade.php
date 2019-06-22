<!-- Header -->
<header class="app-header" id="app-header">
    <div class="container">
        <div class="header-wrapper">
            <!-- Logo -->
            <div class="logo" id="logo">
                <!-- image logo -->
                <a href="{{ route('index') }}" class="image-logo">
                <img src="{{ secure_asset('img/logo.jpg') }}" alt="{{ config('app.name') }}" style="display:inline"/> 
                {{ config('app.name') }}
            </a>
                <!-- HTML logo -->
                <a href="{{ route('index') }}" class="html-logo"><i class="fa fa-code"></i> {{ config('app.name') }}</a>
            </div>
            <!-- Main-Nav -->
            <nav class="main-nav">
                <ul>
                    {{-- <li class="{{ Route::currentRouteName() == 'home' ? 'active': '' }}">
                        <a href="{{ route('home') }}">@lang('Home')</a>
                    </li> --}}
                    <li class="{{ Route::currentRouteName() == 'about' ? 'active': '' }}">
                        <a href="{{ route('about') }}">@lang('About')</a>
                    </li>
                    {{-- <li class="{{ Route::currentRouteName() == 'services' ? 'active': '' }}">
                        <a href="{{ route('services') }}">@lang('Services')</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'portfolio' ? 'active': '' }}">
                        <a href="{{ route('portfolio') }}">@lang('Portfolio')</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'blog' ? 'active': '' }}">
                        <a href="{{ route('blog') }}">@lang('Blog')</a>
                    </li> --}}
                    <li class="{{ Route::currentRouteName() == 'contact' ? 'active': '' }}">
                        <a href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    {{-- <li>
                        <a>@lang('Language')</a>
                        <ul>
                            <li><a href="{{ route('locale', ['locale' => 'fr']) }}">Français</a></li>
                            <li><a href="{{ route('locale', ['locale' => 'en']) }}">English</a></li>
                            <li><a href="{{ route('locale', ['locale' => 'ar']) }}">العربية</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <div class="icon-round-lrg-plain search-toggle">
                    <i class="fa fa-search"></i>
                </div>
            </nav>
        </div>
    </div>
</header>
