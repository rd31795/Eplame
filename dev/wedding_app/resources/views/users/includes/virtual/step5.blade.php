  <form id="fiveEventCreate" action="{{url(route('steps.second'))}}">
                  @csrf
  <div class="formFileds">
     <div class="row">
           <!-- <div class="col-md-12">
               {{textbox($errors, 'Season*', 'seasons')}}
           </div> -->
           <div class="col-lg-6">
            <div class="form-group">
              <label>Event Style <i class="fas fa-info-circle" data-toggle="tooltip" title="Choose your event style. You can create your own by choosing other in options."></i></label>
              <div class="input-field-wrap">
                   <select class="form-control" id="style_type" name="style_type">
                  <?php $EventStyles = \App\Style::where('status',1)->orderBy('title','ASC')->get(); ?>
                  @foreach($EventStyles as $style)
                    <option value="{{$style->id}}">{{$style->title}}</option>
                  @endforeach
                  <option value="0">Others</option>
               </select>
               </div>
            </div>
          </div>

          <div class="col-lg-6" id="style-field-1">
            <div class="form-group">
              <label>Style Title <i class="fas fa-info-circle" data-toggle="tooltip" title="Style Title!"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" name="style_title" id="style_title" placeholder="Style Title">
            </div>
            </div>
          </div>

          <div class="col-md-6" id="style-field-3">
            <div class="form-group ">
              <div class="style-image">
                <label class="label-file">Style Image<i class="fas fa-info-circle" data-toggle="tooltip" title="Style Image!"></i></label>
                 <input type="file" name="style_image" accept="image/*" id="style_image" class="form-control">
              </div>
            </div>
          </div> 

         <div class="col-md-6" id="style-field-2">
          <div class="form-group">
            <label>Style Description <i class="fas fa-info-circle" data-toggle="tooltip" title="Style Description!"></i></label>
            <div class="input-field-wrap">
              <textarea class="form-control" id="style_description" name="style_description" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea>
            </div>
          </div>
         </div>

           <div class="col-md-6">
                

                 <div class="form-group "><label class="control-label">Colour*</label>
                     <input type="hidden" id="countColours" value="1"> 
                      <div class="row field_wrapper">
                       <div class="element col-lg-3 col-md-6">
                            <div class="pick-color-field-wrap">               
                              <div class="form-group">
                                <input type="color" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours[]" value="#000">
                                <input type="text" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                                 <ul class="input-group-btn color-btn acrdn-action-btns">
                                 <li> <button class="icon-btn add_button action_btn" type="button" style=""><i class="fas fa-plus"></i></button></li>
                              </ul>
                              </div>
                            </div>            
                      </div>
                    </div>
                 </div>
           </div>
           <div class="col-md-6">
               {{choosefile($errors, 'Event Picture*', 'event_picture')}}
           </div>

           <div class="col-md-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="agree" value="1" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">I agree to the Terms and Conditions for sharing my Event details with vendors.</label>
                </div>
           </div>
      
         </div>
</div>

         
          
            <div class="btn-wrap text-right">
            <button class="cstm-btn solid-btn btn-back-step" data-action="step4" data-step="4" type="button">Back</button>
                 <button class="cstm-btn solid-btn">Save</button>
            </div>
          




   







<input type="hidden" name="title" value="" id="fort_title">
<input type="hidden" name="event_type" value="" id="fort_event_type">
<input type="hidden" name="description" value="" id="fort_description">
<input type="hidden" name="location" value="" id="fort_location">
<input type="hidden" name="latitude" value="" id="fort_latitude">
<input type="hidden" name="longitude" value="" id="fort_longitude">
<input type="hidden" name="start_date" value="" id="fort_start_date">
<input type="hidden" name="start_time" value="" id="fort_start_time">
<input type="hidden" name="end_date" value="" id="fort_end_date">
<input type="hidden" name="end_time" value="" id="fort_end_time">
<input type="hidden" name="min_person" value="" id="fort_min_person">
<input type="hidden" name="max_person" value="" id="fort_max_person">
<input type="hidden" name="long_description" value="" id="fort_long_description">
<input type="hidden" name="event_budget" value="" id="fort_event_budget">

 

</form>