<style>
  .tooltip {
    z-index: 1000000 !important;
}
</style>

<form id="secondEventCreate">
  <div class="formFileds">
   <div class="row">
       <div class="col-md-6">
           {{datebox($errors, 'Start Date <i class="fas fa-info-circle" data-toggle="tooltip" title="Start date of Event."></i>', 'start_date')}}
           
            <!--  <div class="form-group">
               <label>Event Anticipated Start Time <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i></label>
               <input type="time" name="start_time" id="start_time" class="form-control">
           </div> -->

            <div class="form-group">
            <label>Event Anticipated Start Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Start Time of Event"></i> </label>
           <input type="text" id="start_time" value="2:30 PM" data-format="hh:mm A" class="input-small form-control" name="start_time">
         </div>
           </div>
         <div class="col-md-6">
           {{datebox($errors, 'End Date <i class="fas fa-info-circle" data-toggle="tooltip" title="End date of Event."></i>', 'end_date')}}
          <!-- <div class="form-group">
               <label>Event Anticipated End Time <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i></label>
               <input type="time" name="end_time" id="end_time" class="form-control">
           </div> -->

             <div class="form-group">
            <label>Event Anticipated End Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="End Time of Event"></i> </label>
           <input type="text" id="end_time" value="2:30 PM" data-format="hh:mm A" class="input-small form-control" name="end_time">
         </div>
         </div>
           <div class="col-md-6">

           <div class="form-group">
            <label class="control-label">Min Person <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Minimum Person of Event"></i></label>
            <input type="text" class="form-control" name="min_person" value="" id="min_person" placeholder="Minimum Person">
          </div>

           <!-- {{textbox($errors, 'Min Person <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i>', 'min_person')}} --> 


           </div>
           <div class="col-md-6">
           <div class="form-group">
            <label class="control-label">Max Person <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Maximum Person of Event"></i></label>
            <input type="text" class="form-control" name="max_person" value="" id="max_person" placeholder="Maximum Person">
          </div>
           <!-- {{textbox($errors, 'Max Person <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i>', 'max_person')}} -->
           </div>
        
</div>
</div>


            <div class="btn-wrap text-right">
              <button class="cstm-btn solid-btn btn-back-step" data-action="step1" data-step="1" type="button">Back</button>
              <button class="cstm-btn solid-btn">Next</button>
            </div>
          

  </form>
  <style>
  .glyphicon {
    position: relative !important;
    top: 1px !important;
    display: inline-block !important;
    font-family: 'Glyphicons Halflings' !important;
    font-style: normal !important;
    font-weight: 400 !important;
    line-height: 1 !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}
.bootstrap-datetimepicker-widget table td {
    height: 37px !important;
    line-height: 54px ;
    width: 37px !important;
}
.bootstrap-datetimepicker-widget table td span {
    display: inline-block;
     width: 37px !important; 
     height:37px !important; 
    line-height: 54px;
    margin: 2px 1.5px;
    cursor: pointer;
    border-radius: 4px;
}
.bootstrap-datetimepicker-widget.dropdown-menu {
  margin: 2px 0 !important;
  padding: 4px !important;
  width: 19em !important;
 
}
span.glyphicon.glyphicon-chevron-up {
    display: flex!important;
    align-items: center;
    justify-content: center;
}
span.glyphicon.glyphicon-chevron-down {
    display: flex!important;
    align-items: center;
    justify-content: center;
}
.glyphicon-chevron-up:before {
    content: "\f077";
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
}
.glyphicon-chevron-down:before {
    content: "\f078";
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script>
  $.noConflict();
  jQuery(document).ready(function ($) {

    $('#start_time').datetimepicker({
      format: 'LT'
    });
  });
  
  jQuery(document).ready(function ($) {

    $('#end_time').datetimepicker({
      format: 'LT'
    });
  }); 
</script>