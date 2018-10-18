@if(!$fields)
    <div class="box">
        <div class="header">
            We're sorry!
        </div>
        <p>There are currently no fields available to edit.</p>
    </div>
@endif



@foreach($fields as $field)
   <?php

       $error = false;
       $warning = false;

       $code_script = false;
       $editor_script = false;
       $relation = false;

       # Setup the value
       $empty_value = false;
       if(isset($empty)) {
           foreach($empty as $emp) {
               if($field == $emp) {
                   $empty_value = true;
               }
           }
       }
       if($empty_value or !isset($row)) {
           $value = "";
       } else {
           $value = $row->$field;

           # Check if the value needs to be decrypted
           $decrypt = false;
           foreach($encrypted as $encrypt) {
               if($field == $encrypt) {
                   if($value != ''){
                       $decrypt = true;
                   }
               }
           }
           if($decrypt) {
               try {
                   $value = Crypt::decrypt($value);
               } catch (Exception $e) {
                   $error = trans('backend.decrypt_fail');
               }
           }

           # Check if it's a hashed value, to display it empty
           $hashed_value = false;
           foreach($hashed as $hash) {
               if($field == $hash) {
                   $hashed_value = true;
               }
           }
           if($hashed_value) {
               $value = "";
           }
       }

       $show_field = str_replace('_', ' ', ucfirst($field));

       $type = Schema::getColumnType($table, $field);


       # Set the input type
       if($type == 'string') {
           $input_type = "text";
       } elseif($type == 'integer') {
           $input_type = "number";
       } else {
           $input_type = "text";
       }

       # Check if it needs to be masked
       foreach($masked as $mask) {
           if($mask == $field) {
               $input_type = "password";
           }
       }

       # Check if it's a code
       foreach($code as $cd) {
           if($cd == $field) {
               $code_script = true;
           }
       }

       # Check for the editor values
       foreach($wysiwyg as $ed) {
           if($ed == $field) {
               $editor_script = true;
           }
       }

       # Check if it's a relation
       if(array_key_exists($field, $relations)) {
           $relation = true;
       }

   ?>

   @if($editor_script or $code_script)

       <div class="form-group field">
 <label for="text4" class="control-label col-lg-4">{{ $show_field }} </label>  <div class="col-lg-8">
          @if($editor_script)
              <textarea  name="{{ $field }}" id="ckeditor" class="ckeditor">
              {{ $value }}</textarea>
              </div>
          @elseif($code_script)
          <div class="col-lg-8">
              <pre class="code" id="{{ $field }}-code">{{ $value }}</pre>
              </div>
              <div class="col-lg-8">
              <textarea hidden name="{{ $field }}" id="{{ $field }}">{{ $value }}</textarea>
              <script>
                  var editor = ace.edit("{{ $field }}-code");
                  editor.getSession().on('change', function(){
                      $("#{{ $field }}").val(editor.getSession().getValue());
                  });
              </script>
            </div>
          @endif
      </div>



   @elseif($relation)

         <div class="form-group field">
            <label for="text4" class="control-label col-lg-4">
            {{ $show_field }}</label>
      <div class="col-lg-8">
            <select name="{{ $field }}" id="{{ $field }}" class="dropdown">
                @foreach($relations[$field]['data'] as $relation_data)
                    <?php $relation_value = $relations[$field]['value']; $relation_show = $relations[$field]['show']; ?>
                    <option <?php if($value == $relation_data->$relation_value){ echo "selected"; } ?> value="{{ $relation_data->$relation_value }}">{{ $relation_data->$relation_show }}</option>
                @endforeach
            </select>
            </div>
        </div>

   @else

       @if($type == 'string')

               @if($field == backend::countryCodeField())


                    <?php $cc_value = $value; $cc_id = $field; ?>

                    <?php $no_flags = Backend::noFlags() ?>

                    <?php
                        $countries = Backend::countries();
                    ?>
                  <div class="form-group field">
                        <label for="text1" class="control-label col-lg-4">{{ $show_field }}</label>
                        <div class="col-lg-8">
                     
                    
             
                           
                           
                  <select  name="{{ $field }}" id="{{ $field }}" data-placeholder="Choose a Country..." class="form-control chzn-select" tabindex="2">
                                @foreach($countries as $country)
                                <?php $cc_field_value = array_search($country, $countries); ?>
                                    <option value ="{{ $cc_field_value }}"> @if(in_array($cc_field_value, $no_flags))<i class="help icon"></i>@else<i class="{{ strtolower($cc_field_value) }} flag"></i>@endif{{ $country }}</option> 
                                @endforeach
                            </select>
                     
                   
                    </div>
                    </div>
               @else
             


                   <!-- STRING COLUMN -->
                   <div class="form-group @if($error) error @endif field">
                       <label for="text1" class="control-label col-lg-4">{{ $show_field }}</label>
                        <div class="col-lg-8">
                        <input type="{{ $input_type }}"  id="{{ $field }}" name="{{ $field }}" placeholder="{{ $show_field }}" value="{{ $value }}" class="form-control">
                        @if($error)
                            <div class=" label">
                                {{ $error }}
                            </div>
                        @endif
                        </div>
                   </div>

               @endif

           @elseif($type == 'integer')

               <!-- INTEGER COLUMN -->
               <div class="form-group @if($error) error @endif field">
                   <label for="text1" class="control-label col-lg-4">{{ $show_field }}</label>
                    <div class="col-lg-8">
                    <input type="{{ $input_type }}"  id="{{ $field }}" name="{{ $field }}" placeholder="{{ $show_field }}" value="{{ $value }}" class="form-control">
                    @if($error)
                        <div class="ui pointing red basic label">
                            {{ $error }}
                        </div>
                    @endif
                    </div>
               </div>

           @elseif($type == 'boolean')



                <!-- BOOLEAN COLUMN -->
             <div class="form-group field">
             <label class="control-label col-lg-6"></label>
             
                    <div class="col-lg-6">
                    <div class="checkbox">
                        <input <?php if($value){ echo "checked='checked'"; } ?> type="checkbox" tabindex="0"  name="{{ $field }}" >
                        
                       <label>{{ $show_field }}</label>
                      
                    @if($error)
                        <div class="ui left pointing red basic label">
                            {{ $error }}
                        </div>
                    @endif
                     </div>
                    </div>
                </div>


           @elseif($type == 'text')

                <!-- TEXT COLUMN -->
             <div class="form-group @if($error) error @endif">
                   <label class="control-label col-lg-4">{{ $show_field }}</label>
                    <div class="col-lg-8">
                    <textarea placeholder="{{ $show_field }}" name="{{ $field }}" rows="3" id="{{ $field }}"  class="form-control" >{{ $value }}</textarea>
                    </div>
                    @if($error)
                        <div class="label">
                            {{ $error }}
                        </div>
                    @endif
                </div>

           @else

               <!-- ALL OTHER COLUMN -->
               <div class="form-group @if($error) error @endif">
                    <label class="control-label col-lg-4">{{ $show_field }}</label>
                    <div class="col-lg-8">
                    <input type="{{ $input_type }}"  id="{{ $field }}" name="{{ $field }}" placeholder="{{ $show_field }}" value="{{ $value }}" class="form-control">
                    </div>
                    @if($error)
                        <div class="label">
                            {{ $error }}
                        </div>
                    @endif
               </div>

           @endif
       @foreach($confirmed as $confirm)
           @if($field == $confirm)
               @if($type == 'string')

                   <!-- STRING CONFIRMATION -->
                  <div class="form-group @if($error) error @endif">
                          <label class="control-label col-lg-4">{{ $show_field }} confirmation</label>
                        <div class="col-lg-8">
                        <input type="{{ $input_type }}"  id="{{ $field }}_confirmation" name="{{ $field }}_confirmation" placeholder="{{ $show_field }} confirmation" value="{{ $value }}" class="form-control">
                        </div>
                        @if($error)
                            <div class="ui pointing red basic label">
                                {{ $error }}
                            </div>
                        @endif
                   </div>

               @elseif($type == 'integer')

                   <!-- INTEGER COLUMN CONFIRMATION -->
                   <div class="form-group @if($error) error @endif">
                       <label for="text1" class="control-label col-lg-4">{{ $show_field }} {{ trans('backend.confirmation') }}</label>
                        <div class="col-lg-8">
                        <input type="{{ $input_type }}"  id="{{ $field }}_confirmation" name="{{ $field }}_confirmation" placeholder="{{ $show_field }} confirmation" value="{{ $value }}" class="form-control">
                        </div>
                        @if($error)
                            <div class="ui pointing red basic label">
                                {{ $error }}
                            </div>
                        @endif
                   </div>

               @elseif($type == 'boolean')

                   <!-- BOOLEAN CONFIRMATION -->
                  <div class="form-group">
                        <label class="control-label col-lg-4"></label>
                         <div class="col-lg-8">
                            <div class="checkbox">
                       
                           <input <?php if($value){ echo "checked='checked'"; } ?> type="checkbox" tabindex="0" class="hidden" name="{{ $field }}_confirmation" class="form-control">
                           </div>
                          <label> {{ $show_field }} {{ trans('backend.confirmation') }}</label>
                       </div>
                       @if($error)
                           <div class="ui left pointing red basic label">
                               {{ $error }}
                           </div>
                       @endif
                   </div>

               @elseif($type == 'text')

                   <!-- TEXT COLUMN -->
                 <div class="form-group @if($error) error @endif">
                      <label for="text1" class="control-label col-lg-4">{{ $show_field }} {{ trans('backend.confirmation') }}</label>
                       <div class="col-lg-8">
                       <textarea placeholder="{{ $show_field }}" name="{{ $field }}_confirmation" rows="3" id="{{ $field }}_confirmation" class="form-control">{{ $value }}</textarea>
                       </div>
                       @if($error)
                           <div class="ui pointing red basic label">
                               {{ $error }}
                           </div>
                       @endif
                   </div>

               @else

               <!-- ALL OTHER COLUMN CONFIRMATION -->
               <div class="form-group @if($error) error @endif">
                    <label for="text1" class="control-label col-lg-4">{{ $show_field }} {{ trans('backend.confirmation') }}</label>
                    <div class="col-lg-8">
                    <input type="{{ $input_type }}"  id="{{ $field }}_confirmation" name="{{ $field }}_confirmation" placeholder="{{ $show_field }} confirmation" value="{{ $value }}" class="form-control">
                    </div>
                    @if($error)
                        <div class="ui pointing red basic label">
                            {{ $error }}
                        </div>
                    @endif
               </div>

               @endif

           @endif
       @endforeach

   @endif

@endforeach

    @if(isset($cc_id) and isset($cc_value))
        <script>
            $("#{{ $cc_id }}_dropdown").dropdown("set selected", "{{ $cc_value }}");
            $("#{{ $cc_id }}_dropdown").dropdown("refresh");
        </script>
    @endif

