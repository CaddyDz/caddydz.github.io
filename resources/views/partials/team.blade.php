@if ($members->isNotEmpty())
<section class="section primary team" id="s-team">
	<div class="container">
		<header class="sep active">
			<div class="section-title">
				<h2>Our <i>Team</i></h2>
				<h3>Meet Our Crazy Team</h3>
			</div>
			<p>Our team is highly passionate and motivated to web development and programming, with dedicated expertise and
				the desire for more</p>
		</header>
		<div class="row bp2 team-members">
			@foreach ($members as $member)
				<div class="span-4 team-member">
					<div class="team-pic">
						<div class="mask">
							<a href="{{ secure_asset('storage/' . $member->photo) }}" class="icon-lrg-border-round">
								<i class="fa fa-search"></i>
							</a>
						</div>
						<img src="{{ secure_asset('storage/' . $member->avatar) }}" alt="{{ $member->name }}" />
					</div>
					<h4>{{ $member->name }}</h4>
					<h5>{{ $member->position }}</h5>
					<p>{{ $member->description }}</p>
					@if($member->socialAccounts->isNotEmpty())
					<div class="social-icons">
						@foreach ($member->socialAccounts as $account)
							<a href="{{ $account->pivot->url }}" class="icon-lrg tooltip" data-tip="{{ $account->platform }}">
								<i class="fa {{ $account->icon }}"></i>
							</a>
						@endforeach
					</div>
					@endif
				</div>
			@endforeach
		</div>
	</div>
</section>
@endif
