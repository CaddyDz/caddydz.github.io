@if ($testimonies->isNotEmpty())
<section class="section secondary testimonials">
        <div class="container">
            <div class="testimonials-slider owl-carousel">
                @foreach ($testimonies as $testimony)
                    <div class="testimonial">
                        <div class="profile">
                            <vue-pure-lightbox
                                class="profile profile-alt"
                                alt="{{ $testimony->endorser }}"
                                thumbnail="{{ secure_asset($testimony->avatar) }}"
                                :images="['{{ secure_asset($testimony->avatar) }}']"
                            ></vue-pure-lightbox>
                        </div>
                        <blockquote>
                            <p>{!! $testimony->quote !!}</p>
                            <h5><cite>{{ $testimony->endorser }}</cite></h5>
                        </blockquote>
                    </div>
                @endforeach
            </div>
            <div class="nav-carousel">
                <div class="icon-round-border-lrg nav-prev">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="icon-round-border-lrg nav-next">
                    <i class="fa fa-angle-right"></i>
                </div>
            </div>
        </div>
    </section>
@endif

