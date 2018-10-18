@extends('layouts.admin.panel')
@section('breadcrumb')
<div class="ui breadcrumb">
    <div class="active section">{{ trans('backend.general_settings') }}</div>
</div>
@endsection
@section('title', trans('backend.general_settings'))
@section('icon', "options")
@section('subtitle', trans('backend.general_settings_subtitle', ['id' => $row->id]))
@section('content')
<div class="ui doubling stackable grid container">
    <div class="three wide column"></div>
    <div class="ten wide column">
        <div class="ui very padded segment">
            <form class="ui form" method="POST">
                {{ csrf_field() }}
                @include('backend/forms/master')
                <br>
                <button type="submit" class="ui {{ backend::settings()->button_color }} submit button">{{ trans('backend.submit') }}</button>
            </form>
        </div>
    </div>
    <div class="three wide column"></div>
</div>
@endsection
