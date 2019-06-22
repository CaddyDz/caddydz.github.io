@extends('layouts.app')

@section('content')
    @include('layouts.header', [
        'title' => __('Services'),
        'description' => __('A sneak peek on some of the services I provide'),
        'url' => route('contact'),
        'link' => __('Get in touch')
    ])
    @include('layouts.breadcrumb')
    @include('partials.services')
    @include('partials.quote')
    @include('partials.pricing')
    @include('partials.testimonies')
    @include('partials.portfolio')
    @include('partials.banner')
@stop
