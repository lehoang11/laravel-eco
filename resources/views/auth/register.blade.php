@extends('ecommerce.layouts.master')
@section('content')
    <div class="title m-b-md">
        {{ trans('backend.register_title') }}
    </div>
    <div class="row">
    <div class="col-sm-6">
    <form method="POST">
        {{ csrf_field() }}
        <input name='name' type="text" placeholder="{{ trans('backend.name') }}" class="form-control"><br>
        <input name='email' type="email" placeholder="{{ trans('backend.email') }}" class="form-control" ><br>
        <input name='password' type="password" placeholder="{{ trans('backend.password') }}" class="form-control"><br>
        <input name='password_confirmation' type="password" placeholder="{{ trans('backend.repeat_password') }}" class="form-control">
        <br><br>
        @if(config('services.facebook'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'facebook']) }}">{{ trans('backend.social_register_with', ['provider' => 'facebook']) }}</a>
        @endif
        @if(config('services.twitter'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'twitter']) }}">{{ trans('backend.social_register_with', ['provider' => 'twitter']) }}</a>
        @endif
        @if(config('services.google'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'google']) }}">{{ trans('backend.social_register_with', ['provider' => 'google']) }}</a>
        @endif
        @if(config('services.github'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'github']) }}">{{ trans('backend.social_register_with', ['provider' => 'github']) }}</a>
        @endif
        <br>
        <button class="button button5 btn btn-primary">{{ trans('backend.submit') }}</button>
    </form>
    </div>
    </div>
    <br>
    <br>
@endsection
