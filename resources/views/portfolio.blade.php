@extends('layouts.app')

@section('content')
    <header-component title="@lang('Our Portfolio')"
                    description="@lang('Our latest works, projects and ideas')"
                    url="{{ route('contact') }}"
                    link="@lang('Have a question?')"></header-component>
    @include('layouts.breadcrumb')
    @include('partials.portfolio')
    @include('partials.banner')
@stop
