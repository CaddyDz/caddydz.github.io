@extends('layouts.app')

@section('content')
    @include('layouts.header', [
        'title' => __('My Blog'),
        'description' => __('My latest posts, notes and thoughts'),
        'url' => route('contact'),
        'link' => __('Have an idea?')
    ])
    @include('layouts.breadcrumb')
    <section class="section primary blog-posts">
        <div class="container small-container blog-items">
            <header class="sep active">
                <div class="section-title">
                    <h2>My <i>Blog</i></h2>
                    <h3>Read About My Projects</h3>
                </div>
                <p>
                    Suspendisse tempus sodales neque, eget eleifend <a href="#">turpis tristique</a> eu. Nullam a nisl maximus, ultrices est ut blandit nislr, elit in lobortis mattis.
                </p>
            </header>
            @foreach ($posts as $post)
                <div class="blog-item">
                    <a href="{{ route('post', ['post' => $post->slug]) }}" class="thumb">                  
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" />
                    </a>
                    <a href="{{ $post->uploaderAvatar }}" class="modal-image profile profile-alt">            
                        <img src="{{ $post->uploaderAvatar }}" alt="{{ $post->uploaderName }}" />
                    </a>
                    <div class="date">
                        <span>{{ $post->created_at->format('M') }}</span>
                        <span>{{ $post->created_at->format('j') }}</span>
                    </div>
                    <h4><a href="{{ route('post', ['post' => $post->slug]) }}">{{ $post->title }}</a></h4>
                    <h5>@lang('Posted by') <a href="{{ route('posts', ['user' => $post->uploader ]) }}">
                        {{ $post->uploaderName }}
                    </a></h5>
                    <p>{{ $post->excerpt }}</p>
                    <a class="button round brand-1" href="{{ route('post', ['post' => $post->slug]) }}">
                        @lang('Read More')
                    </a>
                    <small>@lang('Posted in') 
                        <a href="{{ route('category', ['' => $post->category]) }}">
                            {{ $post->categoryName }}
                        </a>
                    </small>
                </div>
                <hr class="stripes" />
            @endforeach
            {{ $posts->links() }}
            <div class="pagination">
                <ul>
                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
    @include('partials.banner')
@stop
