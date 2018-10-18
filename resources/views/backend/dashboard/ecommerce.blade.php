@extends('backend.layouts.ecommerce')

@section('mainbar')

<i class="fa fa-cart-plus" aria-hidden="true"></i>
&nbsp; Ecommerce
@endsection


@section('content')

<h2>Hello! Adminstore:{{ Auth::user()->name }}</h2>
@endsection