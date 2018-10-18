     
 @foreach($products as $item)
     <div class="col-sm-4">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{ route('product_details', ['id' => $item->id,'alias'=>$item->alias]) }}" >
                      <img src="{!!asset('storage/app/'.$item->image)!!}" style="width:100%;height: 250px;" alt="" /></a>
                      <h2>
             ${{ sprintf('%.2f',$item->price)}}
                      </h2>
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