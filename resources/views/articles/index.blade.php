@extends('layouts.app')

@section('content')
    @include('layouts.header', [
        'title' => __('My Blog'),
        'description' => __('My latest articles, notes and thoughts'),
        'url' => route('contact'),
        'link' => __('Have an idea?')
    ])
@include('layouts.breadcrumb')
<section class="section primary blog-articles">
    <div class="container small-container blog-items">
        <header class="sep active">
            <div class="section-title">
                <h2>@lang('My') <i>@lang('Blog')</i></h2>
                <h3>@lang('Read About What am up to')</h3>
            </div>
        </header>
        @foreach ($articles as $article)
        <div class="blog-item">
            <a href="{{ route('article', ['article' => $article->slug]) }}" class="thumb">
                <img src="{{ $article->image }}" alt="{{ $article->title }}" />
            </a>
            <a href="{{ $article->uploaderAvatar }}" class="modal-image profile profile-alt">
                <img src="{{ $article->uploaderAvatar }}" alt="{{ $article->uploaderName }}" />
            </a>
            <div class="date">
                <span>{{ $article->created_at->format('M') }}</span>
                <span>{{ $article->created_at->format('j') }}</span>
            </div>
            <h4><a href="{{ route('article', ['article' => $article->slug]) }}">{{ $article->title }}</a></h4>
            <h5>@lang('Posted by') <a href="{{ route('articles', ['user' => $article->uploader ]) }}">
                    {{ $article->uploaderName }}
                </a></h5>
            <p>{{ $article->excerpt }}</p>
            <a class="button round brand-1" href="{{ route('article', ['article' => $article->slug]) }}">
                @lang('Read More')
            </a>
            <small>@lang('Posted in')
                <a href="{{ route('category', ['' => $article->category]) }}">
                    {{ $article->categoryName }}
                </a>
            </small>
        </div>
        <hr class="stripes" />
        @endforeach
        {{ $articles->links() }}
    </div>
</section>
@include('partials.banner')
@stop
