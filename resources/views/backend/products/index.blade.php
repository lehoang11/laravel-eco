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
               <h5> <a href="{{ route('backend::products')}}" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Product </a></h5>
            </header>

          
  <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>   
	            <tr>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>category</th>
                <th>date</th>
                <th>action</th>
              </tr>
              </thead>
      <tbody>
     @if(count($products) > 0)
      @foreach($products as $product)
        <tr>
            <td> <img src="{!! asset('storage/app/'.$product->image)!!}" width="47" height="47" /></td>
            <td>{{ $product->name}}</td>
            <td>${{ sprintf('%.2f',$product->price)}}</td>
            <td>
      <?php $cate=DB::table('cates')->where('id',$product["cate_id"])->first(); ?>
                    @if(!empty($cate->name))
                   {!! $cate->name!!}
                    @endif      
            </td>
            <td>{{ Backend::fancyDate($product->created_at) }}</td>

 <td>

      <div class="dropdown">
        
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">  <i class="fa fa-cog" aria-hidden="true"></i>&nbsp; Options
             <span class="caret"></span></button>
      <ul class="dropdown-menu">
          <li>  <a href="{{ route('backend::products_edit', ['id' => $product->id]) }}" >
           <i class="fa fa-pencil" aria-hidden="true"></i>
              Product Edit
            </a></li>
   
         
          <li class="divider"></li>
         <li>   <a href="{{ route('backend::products_delete', ['id' => $product->id]) }}" class="item">
            <i class="fa fa-trash" aria-hidden="true"></i>
              Product Delete
            </a></li>
       </ul>
        </div>
            </td>
      
        </tr>
   @endforeach
    @else 
       
<tr>
 you do not have the sort product 
</tr>
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
