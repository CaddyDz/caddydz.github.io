@extends('layouts.app')

@section('content')
<header-component title="@lang('Contact Me')"
    description="@lang('Whether you\'re a student in need for help or a contractor looking to hire, don\'t hesitate to ping me')"
    url="{{ route('contact') }}" link="@lang('Get in touch')"></header-component>
@include('layouts.breadcrumb')
<section class="section primary contact" id="s-contact">
    <div class="container">
        <div class="row contact-widgets">
            <div class="span-4 widget">
                <div class="widget-content">
                    <header>
                        <i class="livicon" data-n="globe" data-op="1" data-c="#C1C1C1" data-s="48" data-hc="false"></i>
                        <div class="title">
                            <h4>Our Address</h4>
                            <h5>Current Residence</h5>
                        </div>
                    </header>
                    <p>
                        16000, Rue Didouche Mourad<br /> Alger Centre 16000<br /> Phone number (+213) 550-647-448<br />
                    </p>
                </div>
            </div>
            <div class="span-4 widget">
                <div class="widget-content">
                    <header>
                        <i class="livicon" data-n="phone" data-op="1" data-c="#C1C1C1" data-s="48" data-hc="false"></i>
                        <div class="title">
                            <h4>Get in Touch</h4>
                            <h5>Corporate Office</h5>
                        </div>
                    </header>
                    <ul>
                        <li>Location: Sidi Moussa, Algiers</li>
                        <li>Phone: 023919561</li>
                        <li>Email: <a href="mailto:salim@sarltphst.com">salim@sarltphst.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="span-4 widget">
                <div class="widget-content">
                    <header>
                        <i class="livicon" data-n="clock" data-op="1" data-c="#C1C1C1" data-s="48" data-hc="false"></i>
                        <div class="title">
                            <h4>Opening Hours</h4>
                            <h5>Please come by</h5>
                        </div>
                    </header>
                    <ul>
                        <li>Sunday - Thursday: 08:00 - 16:30</li>
                        <li>Holidays: Closed</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="stripes" />
        <contact-form-component></contact-form-component>
    </div>
</section>
<div id="map"></div>

@stop
