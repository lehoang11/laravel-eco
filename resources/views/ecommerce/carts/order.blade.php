@extends('ecommerce.layouts.master')


@section('content')
<section>
<div class="container">

  <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Shopping Cart status</a></li>
      </ul>
        <div class="row">               
         <div  class="col-sm-12" style="color: blue;">     
          <h1>Payment &nbsp;</h1>
          <h3>Thank you for buying our product.</h3>
           <h3>we will promptly contact you.</h3>
         <h3> Sales Director: thanks a lot.</h3>
          <a type="button" a href="{{url('/')}}" class="btn btn-success">Home</a>
  
  </div>
  </div>    
</div>
</section>

@endsection