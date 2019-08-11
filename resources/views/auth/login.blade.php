@extends('layouts.app')

@section('content')
<header-component title="@lang('Log In')"
    description="@lang('Sign in to post articles, comment, reply and customize your experience.')"
    url="{{ route('register') }}" link="@lang('Not registered yet?')"></header-component>
@include('layouts.breadcrumb')
<section class="section primary contact" id="s-contact">
    <div class="container">
        <form class="h5-valid" method="POST" action="{{ route('login') }}">
            @csrf
            <fieldset>
                <div class="form-element">
                    <input id="email" type="email" class="box{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="email">@lang('E-mail Address')</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-element">
                    <input id="password" type="password" class="box{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <label for="password">@lang('Password')</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </fieldset>
            <fieldset>
                <div class="input-toggle">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">@lang('Remember Me')</label>
                </div>
            </fieldset>
            <fieldset>
                <button type="submit" class="button large full-width brand-1">Log In</button>
                <a href="{{ route('password.request') }}">
                    @lang('Forgot Your Password?')
                </a>
            </fieldset>
        </form>
    </div>
</section>
@stop
