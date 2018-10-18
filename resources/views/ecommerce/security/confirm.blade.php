@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::permissions') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; security_confirm</a>
@endsection


@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;security_confirm </a></h5>

            </header>
      
        </div>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-lg-3">
    
        <a href="{{ URL::previous() }}" type="button" class="btn btn-default" >
        come back </a>

  
   
       
</div>
    <div class="col-lg-3">
    
          <form class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                      
                            <button id="security_continue" type="submit" class="btn btn-primary"> continue</button>
                      
                    </form>
   
    </div>
</div>




@endsection



