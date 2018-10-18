@extends('backend.layouts.blog')
@section('breadcrumb')
    <div class="ui breadcrumb">
        <a class="section" href="{{ route('backend::blogs') }}">{{ trans('backend.blogs_title') }}</a>
        <i class="right angle icon divider"></i>
        <a class="section" href="{{ route('backend::blogs_posts', ['id' => $row->post->blog->id]) }}">{{ trans('backend.blogs_posts_title') }}</a>
        <i class="right angle icon divider"></i>
        <a class="section" href="{{ route('backend::posts', ['id' => $row->post->blog->id]) }}">{{ $row->post->title }}</a>
        <i class="right angle icon divider"></i>
        <div class="active section">{{  trans('Backend.comments_edit_title') }}</div>
    </div>
@endsection
@section('title', trans('backend.comments_edit_title'))
@section('icon', "edit")
@section('subtitle', trans('backend.comments_edit_subtitle', ['id' => $row->id]))
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
        <br>
    </div>
    <div class="three wide column"></div>
</div>
@endsection
