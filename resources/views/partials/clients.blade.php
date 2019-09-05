@if($clients->isNotEmpty())
<section class="section secondary clients">
    <div class="container">
        <div class="row">
            <div class="span-4 title">
                <div class="section-title title-group">
                    <h2>@lang('Our Clients')</h2>
                    <h5>@lang('Meet Our Happy Clients')</h5>
                </div>
            </div>
            <div class="span-8 client-logos">
                <div class="owl-carousel clients-slider">
                    @foreach ($clients as $client)
                        <a href="{{ $client->url }}" title="{{ $client->name }}">
                            <img src="{{ secure_asset('storage/' . $client->image) }}" alt="{{ $client->name }}" />
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
