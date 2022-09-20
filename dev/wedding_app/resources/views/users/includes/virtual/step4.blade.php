  <form id="forthEventCreate" action="{{url(route('steps.second'))}}">
                  @csrf
                  <div class="formFileds">
     <div class="row">
        <div class="col-md-12">
             <div class="form-group ">
                <label class="control-label">Description* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Tell us about your event. It will be shown on event page."></i></label>
                <textarea class="form-control myTextEditor" id="long_description" name="long_description" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea>
            </div>  
           </div> 
           <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Event Budget* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Enter your event budget."></i></label>
              <input type="text" class="form-control" name="event_budget" value="" id="event_budget" placeholder="Event Budget">
          </div>
           <!-- {{textbox($errors, 'Event Budget*', 'event_budget')}} -->
           </div>

           
         </div>
</div>

         
          
            <div class="btn-wrap text-right">
            <button class="cstm-btn solid-btn btn-back-step" data-action="step3" data-step="3" type="button">Back</button>
                 <button class="cstm-btn solid-btn">Next</button>
            </div>
          

 
 




</form>