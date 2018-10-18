
<div class="col-lg-12">
    <label class="col-lg-3"></label>
    <div class="col-lg-9">
        <input type="checkbox" name="check_all">
        <label>check_all</label>
    </div>
    <label class="col-lg-3"></label>
    <div class="col-lg-9">
      <input type="checkbox" name="uncheck_all">
        <label>uncheck_all</label>  
    </div>
</div>
        <?php $found = false; ?>
        <div class="col-lg-12 fields">
            <?php $counter = 0; ?>
            @foreach($permissions as $perm)
                    <?php $found = true ?>
                    <div class=" inline field">
                        <div class="slider checkbox">
                                <input


                                <?php
                                    $disabled = false;
                                    if(isset($role)){
                                        if($role->hasPermission($perm->slug)) {
                                            echo "checked='checked' ";
                                        }

                                        if($role->su) {
                                            if($perm->su) {
                                                $disabled = true;
                                            }
                                        }
                                    }
                                    if(!$disabled and (!$perm->assignable and !backend::loggedInUser()->su)){
                                        $disabled = true;
                                    }
                                    if($disabled) {
                                        echo "disabled ";
                                    }
                                ?>


                                name="{{ $perm->id }}" type="checkbox"  tabindex="0" class="@if(!$disabled) checkable @endif ">
                            <label>{{ backend::permissionName($perm->slug) }}</label>
                        </div><i data-variation="wide" data-title="{{ $perm->slug }}" data-content="{{ backend::permissionDescription($perm->slug) }}" data-position="right center" class="grey question pop icon"></i>
                        @if(!$perm->assignable and !backend::loggedInUser()->su)<i data-variation="wide" class="red lock icon pop" data-position="right center" data-title="{{ trans('backend.unassignable_permission') }}" data-content="{{ trans('backend.unassignable_permission_desc') }}"></i>@endif
                        @if(!$perm->assignable and backend::loggedInUser()->su and !$disabled)<i data-variation="wide" class="red unlock icon pop" data-position="right center" data-title="{{ trans('backend.unassignable_permission_unlocked') }}" data-content="{{ trans('backend.unassignable_permission_unlocked_desc') }}"></i>@endif
                        @if(backend::loggedInUser()->su and $disabled)<i data-variation="wide" class="red asterisk icon pop" data-position="right center" data-title="{{ trans('backend.su_permission_and_role') }}" data-content="{{ trans('backend.su_permission_and_role_desc') }}"></i>@endif
                    </div>
                    <?php if($counter == 2){echo "</div><div class='col-lg-4 fields'>";$counter=0;}else{$counter++;} ?>
            @endforeach
            <?php if($counter == 2){echo "<div class='inline field col-lg-4'></div>";}    ?>
        </div>
        @if(!$found)
            <div class="col-lg-12 down-spacer">
                <p>No permissions found</p>
            </div>
        @endif
