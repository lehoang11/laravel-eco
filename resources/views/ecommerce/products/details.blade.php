@extends('ecommerce.layouts.master')

@section('content')



<section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        <!--/left-sidebar-->
        @include('ecommerce.partials.pages-all.left-sidebar')  
        <!--/left-sidebar-->  

        </div><!--/col-sm-3-->
        


 <div class="col-sm-9 padding-right">
          <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img src="{!!asset('storage/app/'.$products->image)!!}" alt=""/>
               
              </div>
          



          

            </div>
            <div class="col-sm-7">
              <div class="product-information"><!--/product-information-->
                <img src="{{url('/public/ecommerce/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                <h2>{{ $products->name}}</h2>
               
                <img src="{{url('/public/ecommerce/images/product-details/rating.png')}}" alt="" />
                <span>
                  <span>${{ sprintf('%.2f',$products->price)}}</span>
                  <label>Quantity:</label>
                  <input type="text" value="1" />
                  <a a href="{{ route('addcart', ['id' => $products->id,'alias'=>$products->alias]) }}" type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                  </a>
                </span>
               
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> YEYEYE FASHION</p>
                <a href=""><img src="{{url('/public/ecommerce/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
              </div><!--/product-information-->
            </div>
          </div><!--/product-details-->
          
          <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
    
                <li><a href="#reviews" data-toggle="tab">Comment</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade  active in" id="details" >
              <div class="col-sm-12">
               <div class="product-image-wrapper">
               <p><b>{{ $products->content}}</b> </p>
              <p><b>{{ $products->description}}</b> </p>
              </div>
              </div>
         @foreach($p_details as $item)   
          <div class="col-sm-6">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="{!!asset('storage/app/detail/'.$item->image)!!}" style="width:100%;min-height: 290px;" alt="" />
                      
                      </div>
                    </div>
                  </div>
                </div>
 @endforeach
 
    
              </div>
              
             
              <div class="tab-pane fade " id="reviews" >
                <div class="col-sm-12">
                  <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                 
                  </ul>
               
                  <p><b>Write Your Review</b></p>
                  
                  <form action="#">
                    <span>
                      <input type="text" placeholder="Your Name"/>
                      <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{url('/public/ecommerce/images/product-details/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
              
            </div>
          </div><!--/category-tab-->
          
      <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>
         @include('ecommerce.partials.pages-home.recommended')      
       
          </div><!--/recommended_items-->
          
        </div>
      </div>
    </div>
  </section>
  


@endsection


