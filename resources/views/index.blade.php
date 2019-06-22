@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <section class="hero inactive">
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
                <div class="hero-title">
                    <h2>@lang('Salim Djerbouh')</h2>
                    <h3>@lang('A Modern Web Developer')</h3>
                </div>
                <div class="meta">
                    <p class="blurb">
                        {!! $meta->content !!}
                    </p>
                    <a href="{{ route('contact') }}" target="blank" class="button round brand-1">
                        @lang('Contact Sales')
                    </a>
                    <a href="#s-welcome" class="button round border">@lang('Read More')</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    @include('partials.welcome')
    @include('partials.skills')
    @include('partials.services')
    @include('partials.quote')
    @include('partials.clients')
    @include('partials.portfolio')
    @include('partials.testimonies')
    {{-- @include('partials.blog') --}}
    <div id="map"></div>
@stop
