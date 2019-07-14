@extends('layouts.app')

@section('content')
    <header-component title="@lang('About Me')"
                    description="@lang('So you want to know more huh? check this page out')"
                    url="{{ route('contact') }}"
                    link="@lang('Get in touch')"></header-component>
    @include('layouts.breadcrumb')
    @include('partials.welcome')
    {{-- @include('partials.skills')
    @include('partials.why_choose_us')
    @include('partials.banner')
    @include('partials.team')
    @include('partials.clients')
    @include('partials.more_info')
    @include('partials.stats')
    @include('partials.portfolio') --}}
    <div id="map"></div>
@stop
