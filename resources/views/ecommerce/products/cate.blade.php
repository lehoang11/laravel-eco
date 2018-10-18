@extends('ecommerce.layouts.master')

@section('content')

<div class="row">

 @foreach($products as $item)

    <div class="col-md-3">
      <div class="thumbnail">
        <a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >
          <img src="{!!asset('storage/app/'.$item->image)!!}" alt="" style="width:100%;height: 220px;">
          <div class="caption">
            <p><a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >{!! $item->name!!} </a></p>
            <p>
            <span> ${{ sprintf('%.2f',$item->price)}}</span>

        <button type="button" ><i class="fa fa-shopping-cart"></i> 
        <span class="hidden-xs hidden-sm hidden-md"><a href="{{ route('addcart', ['id' => $item->id,'alias'=>$item->alias]) }}">Add to Cart</a></span></button>            	
            </p>
          </div>
        </a>
      </div>
    </div>
  
  @endforeach

  </div>


      <div class="row">

  Total pages :{!!$products->lastpage()!!}
<ul class="pagination">
  @if($products->currentpage() != 1)
  <li><a href="{!!str_replace('/?','?',$products->url($products->currentpage() -1))!!}">prev</a></li>
@endif
@for ($i =1; $i<= $products->lastpage(); $i= $i +1)
  <li class="{!!($products->currentpage()==$i) ? 'active':''!!}">
  <a href="{!!str_replace('/?','?',$products->url($i))!!}">{!!$i!!}</a></li>
  @endfor
  @if($products->currentpage() !=$products->lastpage())
  <li><a href="{!!str_replace('/?','?',$products->url($products->currentpage() +1))!!}">next</a></li>
@endif
</ul>
      </div>

@endsection


