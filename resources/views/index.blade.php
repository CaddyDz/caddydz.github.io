@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <hero-component @activate-hero="isInactive = false"></hero-component>
    <!-- Main Content -->
    @include('partials.welcome')
    @include('partials.skills')
    @include('partials.services')
    @include('partials.quote')
    @include('partials.clients')
    @include('partials.portfolio')
    @include('partials.testimonies')
    @include('partials.blog')
    <div id="map"></div>
@stop
