@extends('layouts.app')

@section('content')
    <header-component title="@lang('Services')"
                    description="@lang('A sneak peek on some of the services I provide')"
                    url="{{ route('contact') }}"
                    link="@lang('Get in touch')"></header-component>
    @include('layouts.breadcrumb')
    @include('partials.services')
    @include('partials.quote')
    @include('partials.pricing')
    @include('partials.testimonies')
    @include('partials.portfolio')
    @include('partials.banner')
@stop
