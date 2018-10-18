@extends('backend.layouts.media')

@section('mainbar')

<i class="fa fa-file-o" aria-hidden="true"></i>
&nbsp; Media
@endsection


@section('content')

<h2>Hello! Adminstore:{{ Auth::user()->name }}</h2>
@endsection
