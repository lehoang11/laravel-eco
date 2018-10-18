@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::profile') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Users profile</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Profile </a></h5>

            </header>
        </div>
  </div>
</div>
<!--+++++++++++++++/row-header+++++++++++++++++ -->
<!--+++++++++++++++++row-section+++++    +++++ -->
<div class="row">
  <div class="col-lg-9">
        <div class="box">
               <h3>profile</h3>
             <div class="body">
             

   
      <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
                <center>
                    <a class="user-link" href="#">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ url('/')}}/public/backend/img/user.gif">
               
            </a>
                   <br>
                    <br>
                    <div class="from-group">
                    <label class="control-label col-lg-4"></label>
                    <div class="from-group col-lg-8">
                    <input type="file" name="image" >
                    </div>
                    </div>
                </center>
                <br>
              
                @include('backend/forms/master')
             
    
                  <!-- STRING COLUMN -->
                   <div class="form-group  field">
                       <label for="text1" class="control-label col-lg-4">current_password</label>
                        <div class="col-lg-8">
                        <input type="password" id="current_password" name="current_password" placeholder="current_password" value="" class="form-control">
                         </div>
                   </div>
            <br>
              
                
               <button type="submit" class="btn btn-primary  btn-grad" >save</button>
             
            </form>              

    <center>
                @if(config('services.facebook'))
                    @if(!backend::loggedInUser()->hasSocial('facebook'))
                        <br><br>
                        <a href="{{ route('backend::social', ['provider' => 'facebook']) }}" class="ui facebook button">
                            <i class="facebook icon"></i>
                            Facebook
                        </a>
                    @else
                    <br><br>
                        <a class="ui disabled facebook button">
                            <i class="facebook icon"></i>
                            Facebook ({{ trans('backend.social_already_linked') }})
                        </a>
                    @endif
                @endif
                @if(config('services.twitter'))
                    @if(!backend::loggedInUser()->hasSocial('twitter'))
                        <br><br>
                        <a href="{{ route('backend::social', ['provider' => 'twitter']) }}" class="ui twitter button">
                            <i class="twitter icon"></i>
                            Twitter
                        </a>
                    @else
                    <br><br>
                        <a class="ui disabled twitter button">
                            <i class="twitter icon"></i>
                            Twitter ({{ trans('backend.social_already_linked') }})
                        </a>
                    @endif
                @endif
                @if(config('services.google'))
                    @if(!backend::loggedInUser()->hasSocial('google'))
                        <br><br>
                        <a href="{{ route('backend::social', ['provider' => 'google']) }}" class="ui youtube button">
                            <i class="google icon"></i>
                            Google
                        </a>
                    @else
                    <br><br>
                        <a class="ui disabled youtube button">
                            <i class="youtube icon"></i>
                            Google ({{ trans('backend.social_already_linked') }})
                        </a>
                    @endif
                @endif
                @if(config('services.github'))
                    @if(!backend::loggedInUser()->hasSocial('github'))
                        <br><br>
                        <a href="{{ route('backend::social', ['provider' => 'github']) }}" class="ui black button">
                            <i class="github icon"></i>
                            Github
                        </a>
                    @else
                    <br><br>
                        <a class="ui disabled black button">
                            <i class="github icon"></i>
                            Github ({{ trans('backend.social_already_linked') }})
                        </a>
                    @endif
                @endif
            </center>
      </div>
   
    </div>
    <!--+++++++++++/Account+++++++++++ -->
    
        
     </div>
</div>
 
 @endsection