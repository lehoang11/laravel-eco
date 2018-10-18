@extends('layouts.main')
@section('content')
    <div class="title m-b-md">
        {{ trans('backend.reset_password') }}
    </div>
    <form method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{ $email or old('email') }}" placeholder="{{ trans('backend.email') }}" autofocus>
        <input type="password" name="password" placeholder="{{ trans('backend.password') }}">
        <input type="password" name="password_confirmation" placeholder="{{ trans('backend.repeat_password') }}">
        <br><br><br>
        <button class="button button5">{{ trans('backend.submit') }}</button>
    </form>
@endsection
