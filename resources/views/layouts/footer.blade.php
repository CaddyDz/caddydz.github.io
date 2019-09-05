<!-- Footer -->
<footer class="app-footer">
    <div class="container footer-content">
        <div class="row">
            <div class="span-3 footer-col">
                <!-- Logo -->
                <div class="logo">
                    <!-- image logo -->
                    <a href="/" class="image-logo" v-show="!isHtml">
                        <img src="/img/logo.jpg" alt="{{ config('app.name') }}" />
                        {{ config('app.name') }}
                    </a>
                    <!-- HTML logo -->
                    <a href="/" class="html-logo" v-show="isHtml"><i class="fa fa-code"></i>
                        {{ config('app.name') }}</a>
                </div>
                <p>Start your new project with a fresh approach.</p>
                <ul>
                    <li><b><i class="fa fa-globe"></i> Location:</b> Didouche Mourad, Algiers Center City</li>
                    <li><b><i class="fa fa-phone-square"></i> Phone:</b> (+213) 550-647-448</li>
                    <li><b><i class="fa fa-envelope"></i> Email:</b> <a
                            href="mailto:caddy@salimdj.me">caddy@salimdj.me</a></li>
                </ul>
            </div>
            <div class="span-3 footer-col">
                <h3>Newsletter</h3>
                <h4>Sign up to our mailing list</h4>
                <p>No spam, very rare or occasional interesting things to checkout</p>
                <form class="newsletter h5-valid" action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <div class="form-element">
                        <input type="email" class="box" required="" placeholder="Enter your email address"
                            name="email" />
                        <label>Email Address</label>
                        <button type="submit">
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                </form>
                <div class="social-icons">
                    <a href="https://github.com/CaddyDz" class="icon tooltip" data-tip="Github">
                        <i class="fa fa-github"></i>
                    </a>
                    <a href="https://stackoverflow.com/users/5581565/caddy-dz" class="icon tooltip"
                        data-tip="Stack Overflow">
                        <i class="fa fa-stack-overflow"></i>
                    </a>
                    <a href="https://discord.gg/3gC9adW" class="icon tooltip" data-tip="Discord">
                        <img src="{{ secure_asset('svg/discord-brands.svg') }}" width="28px" height="14px">
                    </a>
                    <a href="https://www.instagram.com/saly3301" class="icon tooltip" data-tip="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/saly3301" class="icon tooltip" data-tip="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://linkedin.com/in/salim-djerbouh-01b630b1" class="icon tooltip" data-tip="LinkedIn">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    <a href="https://www.reddit.com/user/caddydz" class="icon tooltip" data-tip="Reddit">
                        <i class="fa fa-reddit"></i>
                    </a>
                    <br><br>
                    <a href="https://soundcloud.com/caddydz" class="icon tooltip" data-tip="Sound Cloud">
                        <i class="fa fa-soundcloud"></i>
                    </a>
                </div>
            </div>
            <div class="span-3 footer-col">
                <h3><i class="fa fa-twitter"></i> @lang('Twitter Feed')</h3>
                <h4>@lang('View my latest tweets')</h4>
                <div id="twitter-feed">
                    <a class="twitter-timeline" data-width="264" data-height="400" data-theme="dark"
                        data-link-color="#242424" href="https://twitter.com/saly3301?ref_src=twsrc%5Etfw">Tweets by
                        saly3301</a>
                </div>
            </div>
            @if ($testimonies->isNotEmpty())
            <div class="span-3 footer-col">
                <h3>Testimonials</h3>
                <h4>See what my clients say</h4>
                <div class="owl-carousel footer-testimonials">
                    @foreach ($testimonies as $testimony)
                        <div class="testimonial">
                            <blockquote>
                                <p>{!! $testimony->quote !!}</p>
                            </blockquote>
                            <div class="cf">
                                <span class="profile">
                                    <vue-pure-lightbox
                                        alt="{{ $testimony->endorser }}"
                                        thumbnail="{{ secure_asset('storage/' . $testimony->avatar) }}"
                                        :images="['{{ secure_asset('storage/' . $testimony->avatar) }}']"
                                    ></vue-pure-lightbox>
                                </span>
                                <cite>
                                    <strong>{{ $testimony->endorserName }}</strong>
                                    <i>{{ $testimony->endorserCompany }}</i>
                                </cite>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="bottom-bar">
        <div class="container">
            <div class="footer-wrapper">
                <!-- Copyright Section -->
                <div class="copyright" id="copyright">
                    © {{ config('app.name') }} {{ date('Y') }}
                </div>
                <!-- Footer Navigation -->
                <nav class="footer-nav">
                    <ul>
                        <li>
                            <a href="/about">
                                About
                            </a>
                        </li>
                        {{-- <li>
                            <a href="services.html">
                                Services
                            </a>
                        </li>
                        <li>
                            <a href="portfolio.html">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="blog.html">
                                Blog
                            </a>
                        </li> --}}
                        <li>
                            <a href="/contact">
                                Contact
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
<!-- end #site-content -->
