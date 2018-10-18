@extends('ecommerce.layouts.master')
@section('content')
    <div class="title m-b-md">
     <h3>   {{ trans('backend.login_title') }}</h3>
    </div>
    <br>
    <br>
    <div class="row">
    <div class="col-sm-6">
    <form method="POST">
        {{ csrf_field() }}

        <input name='email' type="email" placeholder="{{ trans('backend.email') }}" class="form-control" size="5">
        <br><br>
        <input name='password' type="password" placeholder="{{ trans('backend.password') }}" class="form-control" size="5">
        <input type="checkbox" name="remember"> Remember Me<br><br>
        <a href="{{ url('password/reset') }}">{{ trans('backend.forgot_password') }}</a>
        <br><br>
        @if(config('services.facebook'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'facebook']) }}">{{ trans('backend.social_login_with', ['provider' => 'facebook']) }}</a>
        @endif
        @if(config('services.twitter'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'twitter']) }}">{{ trans('backend.social_login_with', ['provider' => 'twitter']) }}</a>
        @endif
        @if(config('services.google'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'google']) }}">{{ trans('backend.social_login_with', ['provider' => 'google']) }}</a>
        @endif
        @if(config('services.github'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'github']) }}">{{ trans('backend.social_login_with', ['provider' => 'github']) }}</a>
        @endif
        <br>
        <button class="button button5 btn btn-primary">{{ trans('backend.submit') }}</button>
    </form>
    </div>
    </div>
    <br><br>
@endsection
