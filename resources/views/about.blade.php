@extends('layouts.app')

@section('content')
    @include('layouts.header', [
        'title' => __('About Me'),
        'description' => __('So you want to know more huh? check this page out'),
        'url' => route('contact'),
        'link' => __('Get in touch')
    ])
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
