@extends('layouts.app')

@section('content')
    @include('layouts.header', [
        'title' => __('My Portfolio'),
        'description' => __('My latest works, projects and ideas'),
        'url' => route('contact'),
        'link' => __('Have a question?')
    ])
    @include('layouts.breadcrumb')
    @include('partials.portfolio')
    @include('partials.banner')
@stop
