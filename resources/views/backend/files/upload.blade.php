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
&nbsp; Upload Media 
            </a></h5>
        </header>
      </div>
    </div>
  </div>



<div class="row">
    <div class="col-lg-6">
        <div class="box">
            <center>
      <h3>{{ trans('backend.information') }}</h3><br>
        <p>{{ trans('backend.files_max_upload_size', ['size' => ini_get('upload_max_filesize')]) }}</p>
        <p>{{ trans('backend.files_max_execution_time', ['time' => ini_get('max_execution_time')]) }}</p>   
            </center>
        </div>
    </div>



    <div class="col-lg-6">
        <div class="box">
            <center>
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
       
                <h3>{{ trans('backend.files_select_files') }}</h3>
                <input required type="file" name="files[]" id="files" multiple="true"><br><br>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary btn-grad">{{ trans('backend.submit') }}</button>
                </form> 
            </center>
        </div>
    </div>


</div>


    
    

@endsection



