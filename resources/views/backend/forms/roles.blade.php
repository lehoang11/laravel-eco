<?php

// Setup the $row variable if it's not set but intended
if(isset($user)){
    $row = $user;
} elseif(isset($blog)){
    $row = $blog;
}

?>
@foreach($roles as $role)
   <div class="form-group field">
   <label class="control-label col-lg-3"></label>
   <div class="col-lg-9">
      <div class="checkbox">

            <input
            <?php
                if(isset($row)){
                    if($row->hasRole($role->name)) {
                        echo "checked='checked' ";
                    }
                }

                $disabled = false;

                if($role->su) {
                    $disabled = true;
                }

                if(!$role->assignable and !backend::loggedInUser()->su){
                    $disabled = true;
                }

                if($disabled) {
                    echo "disabled";

                }
            ?>
            type="checkbox" name="{{ $role->id }}" tabindex="0" >
             <label for="text1">{{ $role->name }}

                @if($role->su)  
                supper
                @endif

                @if(!$role->assignable and !Backend::loggedInUser()->su)

               <i class="fa fa-lock" aria-hidden="true"></i>
                @endif

                @if(!$role->assignable and Backend::loggedInUser()->su)
                <i class="fa fa-unlock" aria-hidden="true"></i>
                
                @endif
            </label>
        </div>
    </div>
    </div>
@endforeach
