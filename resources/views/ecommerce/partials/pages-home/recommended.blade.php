     <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active"> 
 @foreach($data_recom1 as $item)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                        <a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >
                          <img src="{!!asset('storage/app/'.$item->image)!!}" style="width:100%;height: 220px;" alt="" /></a>
                          <h2>${{ sprintf('%.2f',$item->price)}}</h2>
                          <p><a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >{!! $item->name!!} </a> </p>
                          <a href="{{ route('addcart', ['id' => $item->id,'alias'=>$item->alias]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
  @endforeach

                </div>




                <div class="item">  
@foreach($data_recom2 as $item)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                        <a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >
                          <img src="{!!asset('storage/app/'.$item->image)!!}" style="width:100%;height: 220px;" alt="" /></a>
                          <h2>{!!number_format($item->price,0,',','.')!!}VND</h2>
                          <p><a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >{!! $item->name!!} </a> </p>
                          <a href="{{ route('addcart', ['id' => $item->id,'alias'=>$item->alias]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
  @endforeach


                </div>


              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>      
            </div>