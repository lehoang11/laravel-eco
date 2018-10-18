@extends('backend.layouts.base')

@section('mainbar')
         <i class="fa fa-dashboard"></i>&nbsp;
            Dashboard</a></li>
@endsection


@section('content')
{{ trans('backend.dashboard') }}
<h2>Hello! Adminstore:{{ Auth::user()->name }}</h2>
@endsection
