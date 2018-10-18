@extends('layouts.main')
@section('content')
    <div class="title m-b-md">
        {{ trans('backend.activation_account') }}
    </div>
    <form method="POST">
        {{ csrf_field() }}
        <input name='token' type="text" placeholder="{{ trans('backend.activation_key') }}">
        <br><br><br>
        <button class="button button5">{{ trans('backend.submit') }}</button>
    </form>
@endsection
