@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::users') }}">
<i class="fa fa-cogs" aria-hidden="true"></i>
&nbsp; Setting</a>
@endsection


@section('content')

<h2>Hello! Adminstore:{{ Auth::user()->name }}</h2>
@endsection
