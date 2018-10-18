@extends('backend.layouts.media')

@section('mainbar')

<i class="fa fa-file-o" aria-hidden="true"></i>
&nbsp; Media
@endsection

@section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <header>
          <div class="icons"><i class="fa fa-edit"></i></div>
            <h5> <a href="#" ><i class="fa fa-file-o" aria-hidden="true"></i>
&nbsp; Upload documents
            </a></h5>
        </header>
      </div>
    </div>
  </div>



<div class="row">

    <div class="col-lg-9">
        <div class="box">
            <center>
            <br><br>
              <form class="form-horizontal" method="POST">
                {{ csrf_field() }}
                @include('backend/forms/master')
                <br>
                 <button type="submit" class="btn btn-primary btn-grad">{{ trans('backend.submit') }}</button>
            </form>
            </center>
        </div>
    </div>


</div>


    
    

@endsection



