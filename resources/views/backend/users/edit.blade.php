@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::users') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Users</a>
@endsection


@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;New Adminnistrator </a></h5>

            </header>
        </div>
  </div>
</div>
<!--+++++++++++++++/row-header+++++++++++++++++ -->
<!--+++++++++++++++++row-section+++++    +++++ -->
<div class="row">
  <div class="col-lg-9">
        <div class="box">
               <h3>Account</h3>
             <div class="body">
             

    <form class="form-horizontal" method="POST">
                {{ csrf_field() }}
                @include('backend/forms/master')
                <br>
               <button type="submit" class=" submit button btn btn-primary  btn-grad" >save</button>
            </form>              

   
      </div>
   
    </div>
    <!--+++++++++++/Account+++++++++++ -->
    
        
     </div>
</div>
 



 

@endsection



