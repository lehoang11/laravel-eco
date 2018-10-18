@extends('backend.layouts.setting')

@section('mainbar')
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Users
@endsection

@section('content')

                            <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
            
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;New Adminnistrator </a></h5>
            </header>

          
  <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
               
      <tr>
            <th>name</th>
            <th>users</th>
            <th>permissions</th>
            <th>options</th>
  </tr>
      </thead>
       <tbody>
        @foreach($roles as $role)
            <tr>
                <td>
                   
                        {{ $role->name }}
                  @if($role->su)
                  <br> {Super Role
                 eserved role for webmasters}
                    
                  
                  @elseif($role->hasPermission('backend.access'))
                        Backend Access>>
                    The role users have access to the backend admin panel
                        @endif
                  
                </td>
                <td>{{ count($role->users) }} Users</td>

                <td>{{ count($role->Permissions) }} 
                   permissions </td>

                <td>
                  @if($role->allow_editing or backend::loggedInUser()->su)
                  
                      
                  
                          <a href="{{ route('backend::roles_edit', ['id' => $role->id]) }}" >
                            <i class="edit icon"></i>
                            roles_edit
                          </a>||
                          <a href="{{ route('backend::roles_permissions', ['id' => $role->id]) }}" class="item">
                            <i class="lightning icon"></i>
                           roles_edit_permissions
                          </a>
                      @if(!$role->su and $role->id != backend::defaultRole()->id)
                         
                         advanced_options
                          <a href="{{ route('backend::roles_delete', ['id' => $role->id]) }}" >
                            <i class="trash bin icon"></i>
                            roles_delete
                          </a>
                          @endif
                                              
                  @else
                      <div class="ui disabled {{ Backend::settings()->button_color }} icon button">
                          <i class="lock icon"></i>
                      </div>
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
<!-- /.row -->
<!--End Datatables-->
@endsection
