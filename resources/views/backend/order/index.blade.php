@extends('backend.layouts.ecommerce')

@section('mainbar')
<i class="fa fa-shopping-cart" aria-hidden="true"></i>
&nbsp; Order
@endsection

@section('content')

                            <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
            
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::order')}}" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Order </a></h5>
            </header>

          
  <div  class="body">
   <div style="overflow-x:auto;">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>   
	            <tr>
                <th>id</th>
                <th>user_id</th>
                <th>username</th>
                <th>email</th>
                <th>phone</th>
                <th>total</th>
                <th>payment</th>
                <th>payment_info</th>
                <th>address</th>
                <th>message</th>
                <th>security</th>
                <th>status</th>
                <th>date</th>
                <th>action</th>
              </tr>
              </thead>
      <tbody>


     @if(count($order) > 0)
      @foreach($order as $item)
        <tr>
<td>{{$item->id}}
<a href="{{ route('backend::order_details', ['id' => $item->id]) }}">
  <span>view <i class="fa fa-eye" aria-hidden="true"></i></span>
</a>
</td>  
<td>@if($item->user_id) {{$item->user_id}} @else None @endif</td> 
<td>{{$item->user_name}}</td> 
<td>{{$item->user_email}}</td> 
<td>@if($item->user_phone) {{$item->user_phone}} @else None @endif</td> 
<td> ${{ sprintf('%.2f',$item->amount)}} </td> 
<td>@if($item->payment) {{$item->payment}} @else None @endif</td> 
<td>@if($item->payment) {{$item->payment_info}} @else None @endif</td> 
<td>@if($item->address) {{$item->address}} @else None @endif</td> 
<td>@if($item->message) {{$item->message}} @else None @endif</td> 
<td>@if($item->security) {{$item->security}} @else None @endif</td> 
<td>@if($item->status) {{$item->status}} @else None @endif</td> 
<td>{{$item->created_at}}</td> 
<td><a type="button" href="{{ route('backend::order_delete', ['id' => $item->id]) }}" class="btn btn-danger">
  <span> <i class="fa fa-trash-o" aria-hidden="true"></i></span>
</a></td>  
        </tr>
   @endforeach
    @else 
       
<tr>
 you do not have the sort order
</tr>
  @endif

              </tbody>  
              </table>
    
     
            </div>
        </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!--End Datatables-->
@endsection
