@extends('ecommerce.layouts.master')

@section('content')

<section>
    <div class="container">
<div class="row">
<h3>search results for {{ $search }}</h3>
@if(count($data) > 0) 
@foreach($data as $item)
     <div class="col-sm-3">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >
                      <img src="{!!asset('storage/app/'.$item->image)!!}" style="width:100%;height: 250px;" alt="" /></a>
                      <h2>${{ sprintf('%.2f',$item->price)}}</h2>
                      <p><a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >{!! $item->name!!} </a></p>
                      <a href="{{ route('addcart', ['id' => $item->id,'alias'=>$item->alias]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
               <img src="{{url('/public/ecommerce/images/home/new.png')}}" class="new" alt="" />
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                  </ul>
                </div>
              </div>
            </div>
        @endforeach
@else
<div class="col-sm-12">
  <center><h3>No result {{$search}}</h3></center>
</div>
@endif
</div>

      <div class="row">


<ul class="pagination">
  @if($data->currentpage() != 1)
  <li><a href="{!!str_replace('/?','?',$data->url($data->currentpage() -1))!!}">prev</a></li>
@endif
@for ($i =1; $i<= $data->lastpage(); $i= $i +1)
  <li class="{!!($data->currentpage()==$i) ? 'active':''!!}">
  <a href="{!!str_replace('/?','?',$data->url($i))!!}">{!!$i!!}</a></li>
  @endfor
  @if($data->currentpage() !=$data->lastpage())
  <li><a href="{!!str_replace('/?','?',$data->url($data->currentpage() +1))!!}">next</a></li>
@endif
</ul>
      </div>


</div>
</section>
@endsection


