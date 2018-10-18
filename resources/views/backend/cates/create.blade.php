@extends('backend.layouts.ecommerce')

@section('mainbar')
<i class="fa fa-bars" aria-hidden="true"></i>
&nbsp; Category
@endsection

@section('content')

                            <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
            
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::cates')}}" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Category create </a></h5>
            </header>

          <br><br>
        <div  class="body">
       
            <form class="form-horizontal" method="POST">
             {{ csrf_field() }}
<div class="form-group">
<label class="control-label col-lg-4">Cate Parent</label>

<div class="col-lg-8">
  <select name="parent_id" data-placeholder="--Cate Parent--" class="form-control chzn-select" tabindex="2">
  <option value="0" selected>Cate parent</option>
            <?php 
                    Backend::MenuMulti($parent);
                    ?>
   </select>
</div>
</div>




             @include('backend/forms/master')

         <center>
             <button type="submit" class="  button btn btn-primary " >create</button>
         </center>
            </form>  
       
          </div>


        </div>
    </div>
</div>
<!-- /.row -->
<!--End Datatables-->
@endsection
