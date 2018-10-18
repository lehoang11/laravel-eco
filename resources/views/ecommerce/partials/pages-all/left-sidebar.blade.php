<div class="left-sidebar">
            <h2>Category</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->


<?php 
  $menu_level_1= DB::table('cates')->where('parent_id',0)->get();
  ?>
    @foreach($menu_level_1 as $item_level_1)

   <?php 
   $menu_level_2= DB::table('cates')->where('parent_id',$item_level_1->id)->get();
?> 
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#cate{!! $item_level_1->id!!}">
 @if(count($menu_level_2) > 0)
                      <span class="badge pull-right">
                      <i class="fa fa-plus"></i></span>
              @endif        
                   {!! $item_level_1->name!!}
                    </a>
                  </h4>
                </div>

                <div id="cate{!! $item_level_1->id!!}" class="panel-collapse collapse">
                  <div class="panel-body">
                    <ul>
 
@foreach($menu_level_2 as $item_level_2) 
                      <li><a href="{{ route('product_subcates', ['id' => $item_level_2->id,'alias'=>$item_level_2->alias]) }}">{!! $item_level_2->name!!} </a></li>
                  

 @endforeach    
                    </ul>
                  </div>
                </div>
              </div>
 @endforeach       
      
            
     
        
         
            </div><!--/category-products-->
          
            <div class="brands_products"><!--brands_products-->
              <h2>Brands</h2>
              <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#"> <span class="pull-right">(50)</span>Casual Fashion</a></li>
                  <li><a href="#"> <span class="pull-right">(56)</span> Smart Fashion </a></li>
                  <li><a href="#"> <span class="pull-right">(27)</span> Outdoor Fashion</a></li>
                  <li><a href="#"> <span class="pull-right">(32)</span>Sport Fashion</a></li>
                  <li><a href="#"> <span class="pull-right">(32)</span>accessories</a></li>
                  
                </ul>
              </div>
            </div><!--/brands_products-->
            
      
            
            <div class="shipping text-center"><!--shipping-->
              <img src="{{url('/public/ecommerce/images/home/shipping.jpg')}}" alt="" />
            </div><!--/shipping-->
          
          </div><!--/left-sidebar-->