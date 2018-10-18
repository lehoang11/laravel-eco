@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::permissions') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Permissions</a>
@endsection



@section('content')

<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
       <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;{{ trans('backend.permissions_edit_subtitle', ['slug' => $row->slug]) }} </a></h5>

            </header>
        </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
        <div class="box">
          
                <div class="body">
             

    <form class="form-horizontal" method="POST">
            {{ csrf_field() }}
            @include('backend/forms/master')
                
                <br><br>
            <button type="submit" class=" submit button btn btn-primary  btn-grad" >save</button>
        </form>              

 
            </div>
        </div>
    <!--+++++++++++/Account+++++++++++ -->   
    </div>
</div>
@endsection
