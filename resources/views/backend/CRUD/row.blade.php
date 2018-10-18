@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::CRUD') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; {{ trans('backend.database_CRUD') }}</a>
@endsection



@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::CRUD_table', ['table' => $name]) }}" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;{{ trans('backend.CRUD_table_title') }}
 </a></h5>

            </header>
            <div class="body">
            <h3>{{ trans('backend.CRUD_edit_subtitle', ['id' => $row->id, 'table' => $name]) }}</h3>
     <form class="form-horizontal" method="POST">
            {{ csrf_field() }}
                @include('backend/forms/master')
                <br>
               <button type="submit" class=" submit button btn btn-primary  btn-grad" >save</button>
            </form>   
        </div>
        </div>
  </div>
</div>



@endsection
