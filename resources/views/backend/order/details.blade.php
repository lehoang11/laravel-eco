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

        <tr>
<td>{{$row->id}}</td>  
<td>@if($row->user_id) {{$row->user_id}} @else None @endif</td> 
<td>{{$row->user_name}}</td> 
<td>{{$row->user_email}}</td> 
<td>@if($row->user_phone) {{$row->user_phone}} @else None @endif</td> 
<td> ${{ sprintf('%.2f',$row->amount)}} </td> 
<td>@if($row->payment) {{$row->payment}} @else None @endif</td> 
<td>@if($row->payment) {{$row->payment_info}} @else None @endif</td> 
<td>@if($row->address) {{$row->address}} @else None @endif</td> 
<td>@if($row->message) {{$row->message}} @else None @endif</td> 
<td>@if($row->security) {{$row->security}} @else None @endif</td> 
<td>@if($row->status) {{$row->status}} @else None @endif</td> 
<td>{{$row->created_at}}</td> 
<td>option</td>  
        </tr>
 

      

            </tbody>  
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@foreach($order as $item)

<div class="row">
<div class="col-lg-9">
<div style="padding: 5px 0; background: blue;"></div>
 <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
  <tbody>

    <tr> <td><h5>order</h5></td> <td>{{$item->id}}</td> </tr>
    <tr> <td><h5>Product Name</h5></td> <td>{{$item->name}}</td></tr>

    <tr> <td><h5>Image</h5></td> <td><img src="{!!asset('storage/app/'.$item->image)!!}" width="180" height="200" /></td></tr>

    <tr> <td><h5>price</h5></td> <td>${{ sprintf('%.2f',$item->unprice)}}</td></tr>
    <tr> <td><h5>qty</h5></td> <td>{{$item->qty}}</td></tr>

    </tbody>
</table>


  </div>
</div>
@endforeach
<!-- /.row -->
<!--End Datatables-->
@endsection
