@extends('layouts.main')
@section('content')
    <div class="title m-b-md">
        You are logged in!
    </div>
    <br>
    @if(config('services.facebook'))
        @if(!Backend::loggedInUser()->hasSocial('facebook'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'facebook']) }}">{{ trans('backend.social_link', ['provider' => 'facebook']) }}</a>
        @else
            <a class="social">Facebook ({{ trans('backend.social_already_linked') }})</a>
        @endif
    @endif
    @if(config('services.twitter'))
        @if(!Backend::loggedInUser()->hasSocial('twitter'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'twitter']) }}">{{ trans('backend.social_link', ['provider' => 'twitter']) }}</a>
        @else
            <a class="social">Twitter ({{ trans('backend.social_already_linked') }})</a>
        @endif
    @endif
    @if(config('services.google'))
        @if(!Backend::loggedInUser()->hasSocial('google'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'google']) }}">{{ trans('backend.social_link', ['provider' => 'google']) }}</a>
        @else
            <a class="social">Google ({{ trans('backend.social_already_linked') }})</a>
        @endif
    @endif
    @if(config('services.github'))
        @if(!Backend::loggedInUser()->hasSocial('github'))
            <a class="social" href="{{ route('backend::social', ['provider' => 'github']) }}">{{ trans('backend.social_link', ['provider' => 'github']) }}</a>
        @else
            <a class="social">Github ({{ trans('backend.social_already_linked') }})</a>
        @endif
    @endif
@endsection
