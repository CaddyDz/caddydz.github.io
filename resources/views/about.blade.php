@extends('layouts.app')

@section('content')
    <header-component title="@lang('About Us')"
                    description="@lang('So you want to know more huh? check this page out')"
                    url="{{ route('contact') }}"
                    link="@lang('Get in touch')"></header-component>
    @include('layouts.breadcrumb')
    <welcome-component></welcome-component>
    @include('partials.skills')
    @include('partials.why_choose_us')
    @include('partials.banner')
    @include('partials.team')
    @include('partials.clients')
    @include('partials.more_info')
    @include('partials.stats')
    @include('partials.portfolio')
    <div id="map"></div>
@stop
