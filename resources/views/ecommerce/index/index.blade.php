@extends('ecommerce.layouts.master')

@section('content')

<!--slider-->
 @include('ecommerce.partials.pages-home.slider') 

<!--main content-->

<section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        <!--/left-sidebar-->
        @include('ecommerce.partials.pages-all.left-sidebar')  
        <!--/left-sidebar-->  

        </div><!--/col-sm-3-->
        






    <div class="col-sm-9 padding-right">

        <!--features_items-->
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
           
         @include('ecommerce.partials.pages-home.features')     
              
          </div><!--features_items-->
          
          
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>
         @include('ecommerce.partials.pages-home.recommended')      
       
          </div><!--/recommended_items-->
          
        </div>
      </div>
    </div>
  </section>


@endsection


