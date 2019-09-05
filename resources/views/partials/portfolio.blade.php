@if ($projects->isNotEmpty())
<section class="section primary latest-works" id="s-latest-works">
    <div class="container">
        <header class="sep active">
            <div class="section-title">
                <h2>My <i>Portfolio</i></h2>
                <h3>Some of My Recent Works</h3>
            </div>
            <p>I thrive to craft every project with perfectionism in mind and artistic taste at hand</p>
        </header>
        <div class="portfolio-items">
            @foreach ($projects as $project)
                <div class="portfolio-item">
                    <div class="controls">
                        <a href="{{ route('project', ['project' => $project]) }}" class="icon-round-border" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                        <a href="{{ secure_asset('storage/' . $project->screenshot) }}" class="icon-round-border icon-view" @click.prevent="show">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                    <h4><a href="{{ route('project', ['project' => $project]) }}">{{ $project->name }}</a></h4>
                    <p>{{ $project->title }}</p>
                    <vue-pure-lightbox
                                class="mfp-figure"
                                alt="{{ $project->name }}"
                                thumbnail="{{ secure_asset('storage/' . $project->screenshot) }}"
                                :images="['{{ secure_asset('storage/' . $project->screenshot) }}']"
                    ></vue-pure-lightbox>
                    {{-- <img src="{{ secure_asset('storage/' . $project->screenshot) }}" alt="{{ $project->name }}" /> --}}
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
