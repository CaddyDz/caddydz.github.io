@if ($articles->isNotEmpty())
<section class="section primary latest-articles" id="s-latest-articles">
    <div class="container">
        <header class="sep active">
            <div class="section-title">
                <h2>@lang('Our') <a href="{{ route('blog') }}">@lang('Blog')</a></h2>
                <h3>@lang('Read About Our Ideas')</h3>
            </div>
            <p class="sub-text">@lang('Read about upcoming projects, products or ideas and software solutions in
                genereal, follow me on') <a href="https://medium.com/@saly3301">Medium</a> @lang('to get notified!')</p>
        </header>
        <div class="row blog-items">
            @foreach ($articles as $article)
            <div class="span-4 blog-item">
                <a href="{{ route('article', ['article' => $article]) }}" class="thumb">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" />
                </a>
                <vue-pure-lightbox
                    class="profile profile-alt"
                    thumbnail="{{ $article->posterAvatar }}"
                    :images="['{{ $article->posterAvatarFull }}']"
                ></vue-pure-lightbox>
                <div class="date">
                    <span>{{ $article->created_at->shortEnglishMonth }}</span>
                    <span>{{ $article->created_at->day }}</span>
                </div>
                <h4><a href="{{ route('article', ['article' => $article]) }}">
                        {{ $article->title }}
                    </a></h4>
                <h5>@lang('Posted by') <a href="{{ route('articlesBy', ['user', $article->user]) }}">
                        {{ $article->user->name }}
                    </a></h5>
                <p>{{ $article->excerpt }}</p>
                <a class="button round brand-1" href="{{ route('article', ['article' => $article]) }}">@lang('Read
                    More')</a>
                <small>@lang('Posted in')
                    <a href="{{ route('category', ['category' => $article->category->name]) }}">
                        {{ $article->category->name }}
                    </a>
                </small>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
