@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::CRUD') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Roles</a>
@endsection


@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="{{ route('backend::CRUD') }}" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Database CRUD
 </a></h5>

            </header>
        </div>
  </div>
</div>
<!--+++++++++++++++/row-header+++++++++++++++++ -->
<!--+++++++++++++++++row-section+++++    +++++ -->
<div class="row">
  <div class="col-lg-12">
      <div class="box">
        <h3>Create, Read, Update, Delete</h3>
          <div class="body">
      <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
               
      <tr>
            <th>{{ trans('backend.table') }}</th>
                  <th>{{ trans('backend.columns') }}</th>
                  <th>{{ trans('backend.rows') }}</th>
                  <th>{{ trans('backend.edit') }}</th>
  </tr>
      </thead>
       <tbody>
        @foreach($tables as $table)
                    <tr>
                        <td>{{ $table }}</td>
                        <td>{{ count(\Schema::getColumnListing($table)) }}</td>
                        <td>{{ count(\DB::table($table)->get()) }}</td>
                        <td>
                            <a href="{{ route('backend::CRUD_table', ['table' => $table]) }}" class="ui  button">{{ trans('backend.edit') }}</a>
                        </td>
                    </tr>
        @endforeach
     
      </tbody>          
                 </table>
            </div>       

  
   
          </div>
      </div>
    <!--+++++++++++/Account+++++++++++ -->  
  </div>
</div>
 



 

@endsection



