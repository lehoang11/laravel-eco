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
               <h5> <a href="{{ route('backend::cates')}}" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Category </a></h5>
            </header>

          
  <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>   
	            <tr>
                <th>Name</th>
                <th>Slug(alias)</th>
                <th>Parent</th>
                <th>Sort order</th>
                <th>Options</th>
              </tr>
              </thead>
      <tbody>
     @if(count($cates) > 0)
      @foreach($cates as $cate)
        <tr>
            <td>{{ $cate->name}}</td>
            <td>{{ $cate->alias}}</td>
            <td>
         @if($cate['parent_id']==0)
                  {!!'0'!!}
                  @else
  <?php 
    $parent=DB::table('cates')->where('id',$cate['parent_id'])->first();
     echo $parent->name;
  ?>
      @endif        
            </td>
            <td>{{ $cate->sort_order}}</td>

 <td>

      <div class="dropdown">
        
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">  <i class="fa fa-cog" aria-hidden="true"></i>&nbsp; Options
             <span class="caret"></span></button>
      <ul class="dropdown-menu">
          <li>  <a href="{{ route('backend::cates_edit', ['id' => $cate->id]) }}" >
           <i class="fa fa-pencil" aria-hidden="true"></i>
              Cate Edit
            </a></li>
   
         
          <li class="divider"></li>
         <li>   <a href="{{ route('backend::cates_delete', ['id' => $cate->id]) }}" class="item">
            <i class="fa fa-trash" aria-hidden="true"></i>
              Cate Delete
            </a></li>
       </ul>
        </div>
            </td>
      
        </tr>
   @endforeach
    @else 
       
<tr>you do not have the sort cate </tr>
  @endif

              </tbody>  
              </table>
    
     
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!--End Datatables-->
@endsection
