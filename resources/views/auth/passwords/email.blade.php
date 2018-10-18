@extends('layouts.main')
@section('content')
    <div class="title m-b-md">
        {{ trans('backend.reset_password') }}
    </div>
    <form method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <input type="email" name="email" placeholder="{{ trans('backend.email') }}" value="{{ old('email') }}">
        <br><br><br>
        <button class="button button5">{{ trans('backend.send_password_link') }}</button>
    </form>
@endsection
