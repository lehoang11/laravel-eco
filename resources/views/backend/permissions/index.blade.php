@extends('backend.layouts.setting')

@section('mainbar')
<a href="{{ route('backend::permissions') }}">
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Permissions</a>
@endsection


@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Permissions </a></h5>

            </header>

 <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
               
      <tr>
            <th>name</th>
            <th>description</th>
            <th>slug</th>
            <th>roles</th>
            <th>options</th>
      </tr>

        </thead>
            <tbody>
     @foreach($permissions as $perm)
                    <tr>
                        <td>
                           
                                {{ backend::permissionName($perm->slug) }}
                           
                        </td>
                        <td>
                           
                                {{ backend::permissionDescription($perm->slug) }}
                          
                        </td>
                        <td>
                           
                                {{ $perm->slug }}
                           
                        </td>
                        <td>{{ count($perm->roles) }}&nbsp;<span>Roles</span>  </td>
                        <td>
                          @if(backend::loggedInUser()->hasPermission('backend.permissions.edit') or (backend::loggedInUser()->hasPermission('backend.permissions.delete') and !$perm->su))
                             
                            
                                  <a href="{{ route('backend::permissions_edit', ['id' => $perm->id]) }}" class="item">
                                    <i class="edit icon"></i>
                                    {{ trans('backend.permissions_edit') }}
                                  </a>
                                  @if(backend::loggedInUser()->hasPermission('backend.permissions.delete') and !$perm->su)

                                 
                                  <a href="{{ route('backend::permissions_delete', ['id' => $perm->id]) }}" class="item">
                                    <i class="trash bin icon"></i>
                                    {{ trans('backend.permissions_delete') }}
                                  </a>
                                  @endif
                                </div>
                              </div>
                          @else
                            
                                  <i class="fa fa-lock "></i>
                             
                          @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>          
        </table>
    </div>

        </div>
    </div>
 </div>




@endsection



