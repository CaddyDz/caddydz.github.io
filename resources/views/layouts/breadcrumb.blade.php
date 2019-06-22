<!-- Breadcrumb -->
<nav class="breadcrumb">
    <div class="container">
        <ul>
            <li class="home"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="current"><a href="{{ url()->current() }}">{{ Route::currentRouteName() }}</a></li>
        </ul>
    </div>
</nav>
