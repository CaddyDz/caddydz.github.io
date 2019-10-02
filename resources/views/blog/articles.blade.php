@extends('layouts.app')

@section('content')
<header-component title="@lang('Our Blog')"
                description="@lang('Our latest articles, notes and thoughts')"
                url="{{ route('contact') }}"
                link="@lang('Have an idea?')"></header-component>
@include('layouts.breadcrumb')
<section class="section primary blog-articles">
    <div class="container small-container blog-items">
        @if($articles->isNotEmpty())
        <header class="sep active">
            <div class="section-title">
                <h2>@lang('Our') <i>@lang('Blog')</i></h2>
                <h3>@lang('Read About What am up to')</h3>
            </div>
        </header>
        @foreach ($articles as $article)
        <div class="blog-item">
            <a href="{{ route('article', ['article' => $article->slug]) }}" class="thumb">
                <img src="{{ $article->image }}" alt="{{ $article->title }}" />
            </a>
            <a href="{{ $article->posterAvatarFull }}" class="modal-image profile profile-alt">
                <img src="{{ $article->posterAvatar }}" alt="{{ $article->user->name }}" />
            </a>
            <div class="date">
                <span>{{ $article->created_at->format('M') }}</span>
                <span>{{ $article->created_at->format('j') }}</span>
            </div>
            <h4><a href="{{ route('article', ['article' => $article->slug]) }}">{{ $article->title }}</a></h4>
            <h5>@lang('Posted by') <a href="{{ route('articles', ['user' => $article->user ]) }}">
                    {{ $article->user->name }}
                </a></h5>
            <p>{{ $article->excerpt }}</p>
            <a class="button round brand-1" href="{{ route('article', ['article' => $article->slug]) }}">
                @lang('Read More')
            </a>
            <small>@lang('Posted in')
                <a href="{{ route('category', ['category' => $article->category]) }}">
                    {{ $article->category->name }}
                </a>
            </small>
        </div>
        <hr class="stripes" />
        @endforeach
        {{ $articles->links() }}
        @else
        <header class="sep active">
            <div class="section-title">
                <h2>@lang('Our') <i>@lang('Blog')</i></h2>
                <h3>@lang('There are no articles yet.')</h3>
            </div>
        </header>
        @endif
    </div>
</section>
@include('partials.banner')
@stop
