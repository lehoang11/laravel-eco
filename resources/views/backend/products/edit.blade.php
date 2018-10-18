@extends('backend.layouts.ecommerce')

@section('mainbar')
<i class="fa fa-bars" aria-hidden="true"></i>
&nbsp; Product
@endsection

@section('content')

                            <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
            
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::products')}}" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Product create </a></h5>
            </header>

          <br><br>
       </div>
    </div>
</div>

<div class="body">
 <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="formproduct">
   {{ csrf_field() }}
    <div class="row">
      <div class="col-lg-8">
        <div class="box">
    <div class="form-group">
    <label class="control-label col-lg-4">Category</label>

     <div class="col-lg-8">
      <select name="cate_id" data-placeholder="--Category--" class="form-control chzn-select" tabindex="2">
      <option value="0" >Category</option>
            <?php 
    function MenuMulti($data,$parent_id = 0,$str="---|",$select=0){

     foreach ($data as  $val) {
        $id =$val["id"];
        $name = $val["name"];
        if($val["parent_id"] ==$parent_id){
            if ($select != 0 && $id == $select) {
          echo '<option value ="'.$id.'" selected>'.$str."". $name.'</option>';
            }else{
                echo '<option value ="'.$id.'">'.$str."".$name.'</option>';
            }
            MenuMulti($data,$id,$str."---|",$select);
        }  } }
         MenuMulti($cate,0,"---|",$row['cate_id']);
                    ?>
   </select>
</div>
</div>  
          @include('backend/forms/master')      
    </div>
 </div>
        <div class="col-lg-4">
        <div class="box">
        <h3>Add image</h3>
        <input  type="file" name="file">
        <input type="hidden" name="filedl" value="{!! $row['image']!!}">
 <img src="{!! asset('storage/app/'.$row['image'])!!}" width="100" height="100" />
        </div>

   <div class="box">
        <h3>Image Details</h3>
        <span>Tip:You can choose to upload multiple images at once</span>
        <input  type="file" name="files[]" id="files" multiple="true"><br><br>

      <div class="body">
                 @foreach($pro_details as $key=> $item)
                    <div id="{!! $key !!}">
                   

 <img idFILE="{!! $item['id'] !!}" src="{!! asset('storage/app/detail/'.$item['image'])!!}"  width="100" height="100" />
     <a href="javascript:void(0)" type="button" id="img_detail" class="btn btn-danger btn-circle "><i class="fa fa-times"></i></a>
                      </div>
 
                    @endforeach

              
      </div>
     </div>
  </div>

  </div>
 



    <div class="row">
      <div class="col-lg-12">
        <div class="box">

   <button type="submit" class="  button btn btn-primary" >save</button>  

        </div>
      </div>
    </div>
</form>
</div>

     
  

 <script src="{{ url('/') }}/public/backend/js/myscript.js"></script>           

<!-- /.row -->
<!--End Datatables-->
@endsection
