<!-- Footer -->
<footer class="app-footer">
    <div class="container footer-content">
        <div class="row">
            <div class="span-3 footer-col">
                <!-- Logo -->
                <div class="logo">
                    <!-- image logo -->
                    <a href="/" class="image-logo">
                        {{-- <img src="assets/images/logo.png" alt="One Nexus" /> --}}
                    </a>
                    <!-- HTML logo -->
                    <a href="/" class="html-logo"><i class="fa fa-code"></i> {{ config('app.name') }}</a>
                </div>
                <p>Start your new project with a fresh approach.</p>
                <ul>
                    <li><b><i class="fa fa-globe"></i> Location:</b> Didouche Mourad, Algiers Center City</li>
                    <li><b><i class="fa fa-phone-square"></i> Phone:</b> (+213) 550-647-448</li>
                    <li><b><i class="fa fa-envelope"></i> Email:</b> <a href="mailto:caddy@caddydz.me">caddy@caddydz.me</a></li>
                </ul>
            </div>
            <div class="span-3 footer-col">
                <h3>Newsletter</h3>
                <h4>Sign up to our mailing list</h4>
                <p>No spam, very rare or occasional interesting things to checkout</p>
                <form class="newsletter h5-valid" action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <div class="form-element">
                        <input type="email" class="box" required="" placeholder="Enter your email address" name="email"/>
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
                    <a href="https://stackoverflow.com/users/5581565/caddy-dz" class="icon tooltip" data-tip="Stack Overflow">
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
                <h3><i class="fa fa-twitter"></i> Twitter Feed</h3>
                <h4>View my latest tweets</h4>
                <div id="twitter-feed">
                    <div class="twitter-article">
                        <div class="twitter-pic">
                            <a href="https://twitter.com/saly3301" class="modal-image">
                                {{-- Call Twitter API to get the avatar --}}
                                <img width="50" height="50" src="https://pbs.twimg.com/profile_images/1140969530568712192/9hhTEDXf_normal.jpg" alt="Caddy DZ">
                            </a>
                            <div class="tweet-time"><a href="https://twitter.com/saly3301/status/1050454769515593728">11 Oct</a></div>
                        </div>
                        <div class="twitter-text">
                            <div class="tweetprofilelink">
                                <strong><a href="https://twitter.com/saly3301">Caddy DZ</a></strong> <a href="https://twitter.com/cortexpodcast">@cortexpodcast</a>
                            </div>
                            <p>Is it down or just for me?</p>
                        </div>
                    </div>
                    <div class="twitter-article">
                        <div class="twitter-pic">
                            <a href="https://twitter.com/saly3301" class="modal-image">
                                <img width="50" height="50" src="https://pbs.twimg.com/profile_images/1140969530568712192/9hhTEDXf_normal.jpg" alt="Caddy DZ">
                            </a>
                            <div class="tweet-time"><a href="https://twitter.com/saly3301/status/1021062586027175936">22 Jul</a></div>
                        </div>
                        <div class="twitter-text">
                            <div class="tweetprofilelink">
                                <strong><a href="https://twitter.com/saly3301">Caddy DZ</a></strong> <a href="https://twitter.com/SlackHQ">@SlackHQ</a>
                            </div>
                            <p>I like you too #slack</p>
                        </div>
                    </div>
                </div>
            </div>
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
