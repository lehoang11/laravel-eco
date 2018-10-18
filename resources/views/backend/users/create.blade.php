@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::users') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Users</a>
@endsection


@section('content')
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Create User</h5>
             
        </header>
        </div>
        </div></div>
       <!-- /.row --> 

<div class="row">
 <form  method="POST">
<div class="col-lg-6">
    <div class="box dark">
        <div id="div-1" class="body">
            <div class="form-horizontal">


             {{ csrf_field() }}
                        @include('backend/forms/master')

            </div>
        </div>
    </div>
</div>

<!--END TEXT INPUT FIELD-->

<!--BEGIN SELECT        -->

<div class="col-lg-6">
<div class="box">

<div id="div-2" class="body">
<div class="form-horizontal">

      @include('backend.forms.roles')    

<hr><br>
    <div class="form-group">
      <label class="control-label col-lg-4"></label>
         <div class="col-lg-8">
            <div class="checkbox">
              <label>
     <input  type="checkbox" id="active" name="active" class="uniform">  Activate User
              </label>
          </div>     
        </div>
    </div>
 <div class="form-group">
      <label class="control-label col-lg-4"></label>
         <div class="col-lg-8">
            <div class="checkbox">
              <label>
     <input  type="checkbox" id="send_activation" name="send_activation"  class="uniform">  Send Activation Email
              </label>
          </div>     
        </div>
    </div>
     <div class="form-group">
      <label class="control-label col-lg-4"></label>
         <div class="col-lg-8">
            <div class="checkbox">
              <label>
     <input  type="checkbox" id="mail_checkbox" name="mail"  class="uniform"> Send Welcome Email
              </label>
          </div>     
        </div>
    </div>

</div>
</div>
</div>
<!--END SELECT-->
 
        <div class="col-lg-12 field">
            
            <button type="submit" class=" submit button btn btn-primary  btn-grad" >create</button>
   
 
  </div>
</form>
</div>
<!-- /.row -->

 
        </script>
    <script>
    $('#active').change(function(){
        if(this.checked) {
            $('#send_activation').prop('checked', false);
        }
    });
    $('#send_activation').change(function(){
        if(this.checked) {
            $('#active').prop('checked', false);
        }
    });
</script>

@endsection



