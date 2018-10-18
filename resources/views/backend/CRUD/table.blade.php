@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::CRUD') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Roles</a>
@endsection



@section('subtitle', trans('backend.CRUD_table_subtitle', ['table' => $name]))

@section('content')
<?php require(Backend::dataPath() . '/Edit/DevGet.php'); $allow_edit = $allow; ?>
<?php require(Backend::dataPath() . '/Create/DevGet.php'); ?>

<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::CRUD') }}" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Database CRUD
 </a></h5>

            </header>
                @if($allow and Schema::hasColumn($name, 'id'))
                <a href="{{ route('backend::CRUD_create', ['table' => $name]) }}" class="btn btn-primary  btn-grad">{{ trans('backend.create') }}</a><br>
            @else
                <a class="ui disabled btn btn-primary  btn-grad">{{ trans('backend.create') }}</a><br>
            @endif
        </div>
  </div>
</div>

 
<div class="row">
  <div class="col-lg-12">
      <div class="box">
   <div style="overflow-x:auto;">
        
          <table  class="table table-bordered table-condensed table-hover table-striped">
      			  <thead>
      			    <tr>
                        @foreach($columns as $column)
                            <th>{{$column}}</th>
                        @endforeach
                        <th>{{ trans('backend.edit') }}</th>
                        <th>{{ trans('backend.delete') }}</th>
      			    </tr>
      			  </thead>
      			  <tbody>
                      <?php
                          require(Backend::dataPath() . '/DevData.php');
                          $hide = [];
                          if(array_key_exists($name, $data)){
                              if(array_key_exists('hide_display', $data[$name])){
                                  $hide = $data[$name]['hide_display'];
                              }
                          }
                      ?>
                      @foreach($rows as $row)
                          <tr>
                              @foreach($columns as $column)
                                  <td>@if(in_array($column,$hide))<i>HIDDEN</i>@else @if($row->$column == "")<i>EMPTY</i>@else {{ $row->$column }} @endif @endif</td>
                              @endforeach
                              @if($allow_edit and \Schema::hasColumn($name, 'id'))
                                  <td>
                                      <a href="{{ route('backend::CRUD_edit', ['table' => $name, 'id' => $row->id]) }}" class="btn btn-primary  btn-grad">{{ trans('backend.edit') }}</a>
                                  </td>
                              @else
                                  <td>
                                      <a class="ui disabled btn btn-primary  btn-grad">{{ trans('backend.edit') }}</a>
                                  </td>
                              @endif
                              <?php
                                  # Check if you're allowed to delete rows
                                  require(Backend::dataPath() . '/DevData.php');
                                  $del = true;
                                  if(array_key_exists($name, $data)){
                                      if(array_key_exists('delete', $data[$name])) {
                                          if(!$data[$name]['delete']){
                                              $del = false;
                                          }
                                      }
                                  }
                              ?>
                              @if($del)
                                  <td>
                                      <a href="{{ route('backend::CRUD_delete', ['table' => $name, 'id' => $row->id]) }}" class="btn btn-primary  btn-grad">{{ trans('backend.delete') }}</a>
                                  </td>
                              @else
                                  <td>
                                      <a class="ui disabled btn btn-primary  btn-grad">{{ trans('backend.delete') }}</a>
                                  </td>
                              @endif
                          </tr>
                      @endforeach
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>  


   
@endsection
