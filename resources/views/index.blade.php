<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Modern web developer, laravel artisan">
	<meta name="author" content="Salim Djerbouh">
	<title>Salim Djerbouh</title>
	<link rel="stylesheet" href="/assets/css/color.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Mono|Inconsolata" rel="stylesheet">
	<link href="https://cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body>

	<!--Header-->
	<header class="main-header" style="background-image: url(/assets/img/img_article_photo.jpg)">
		<div class="container">
			<div class="row personal-profile">
				<div class="col-md-4 personal-profile__avatar">
					<img class="" src="assets/img/img_avatar.jpg" alt="avatar">
				</div>
				<div class="col-md-8">
					<p class="personal-profile__name">Salim Djerbouh</p>
					<p class="personal-profile__work">backend developer, Software engineer</p>
					<div class="personal-profile__contacts">
						<dl class="contact-list contact-list__opacity-titles">
							<dt>Age:</dt>
							<dd>26</dd>
							<dt>Phone:</dt>
							<dd><a href="tel:+213551081911">+213551081911</a></dd>
							<dt>Email:</dt>
							<dd><a href="mailto:salim@sitando.com">salim@sitando.com</a></dd>
							<dt>Address:</dt>
							<dd>Akid Lotfi, Oran, Algeria</dd>
						</dl>
					</div>
					<p class="personal-profile__social">
						<a href="https://github.com/CaddyDz" target="_blank"><i class="fa fa-github"></i></a>
						<a href="https://linkedin.com/in/CaddyDz" target="_blank"><i class="fa fa-linkedin-square"></i></a>
						<a href="https://facebook.com/saly3301" target="_blank"><i class="fa fa-facebook-square"></i></a>
					</p>
				</div>
			</div>
		</div>
	</header>
	<!--Header-->

	<section id="hello" class="container section">
		<div class="row">
			<div class="col-md-10">
				<h2 id="hello_header" class="section__title">Hi_</h2>
				<p class="section__description">
					I am senior Web developer able to build a Web presence from the ground up - from concept, navigation,
					layout and programming to UX and SEO. Skilled at writing well-designed, testable and efficient code using current best practices in Web development. Fast learner, hard worker and team player who is proficient in an array of scripting languages and multimedia Web tools.
				</p>
				<a href="{{ route('cv') }}" class="section_btn site-btn">
					<img src="/assets/img/img_btn_icon.png">
					Download CV
				</a>
			</div>
		</div>
	</section>
</body>

</html>
