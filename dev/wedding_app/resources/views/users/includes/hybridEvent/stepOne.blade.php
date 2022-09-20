<style>
    .tooltip {
    z-index: 1000000 !important;
}
.start-end-sec label {
    font-weight: 600;
}
</style>
<form id="firstEventCreate" enctype="multipart/form-data">
    <div class="formFileds">
        <div class="row">
            <input type="hidden" name="event" id="event" value="2">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">Event Type* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Events type like Anniversary,Baby Shower etc."></i></label>
                    <div class="input-field-wrap">
                        <select class="form-control select2" id="event_type" name="event_type" data-action="{{route('user_get_event_category')}}">
                            <option value="">Select</option>
                            <?php $VendorEvents = \App\Event::where('status',1)->orderBy('name','ASC')->get(); ?>
                            @foreach($VendorEvents as $event)
                            <option value="{{$event->id}}">{{$event->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">Event Title* <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Title!"></i></label>
                    <div class="input-field-wrap">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Event Title">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">Description* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Tell us about your event. It will be shown on event page."></i></label>
                    <textarea class="form-control myTextEditor" id="description" name="description" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">Total Seats* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Maximum Person of Event"></i></label>
                    <input type="text" class="form-control" name="max_person" value="" id="max_person" placeholder="Maximum Person">
                </div>
            </div>
            <!-- ******* -->
            <div class="cstm-form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Physical seats* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Physical seats"></i> </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="physical_seat" name="physical_seat">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Virtual seats* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Virtual seats"></i> </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="virtual_seat" name="virtual_seat">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h6 id="virtual" class="Physical-seats-error"></h6>
                </div>
            </div>
            <!-- ******** -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">Event Location* <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i></label>
                    <div class="input-field-wrap">
                        <input type="text" class="form-control" id="location" name="location"  placeholder="Event Place">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>
                </div>
            </div>
        </div>
        <div class="start-end-sec">
            <label class="control-label">When will your event start and end?* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Maximum Person of Event"></i></label>
            <div class="row">
                <div class="col-md-6">
                    {{datebox($errors, '<label class="control-label">Start Date <i class="fas fa-info-circle" data-toggle="tooltip" title="Start date of Event."></i></label>', 'start_date')}}
                </div>
                <div class="col-md-6">
                    {{datebox($errors, '<label class="control-label">End Date <i class="fas fa-info-circle" data-toggle="tooltip" title="End date of Event."></i></label>', 'end_date')}}
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Start Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Start Time of Event"></i> </label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" id="start_time" name="start_time" />
                            <!-- <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
          </span> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
               <label>Event Anticipated End Time <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i></label>
               <input type="time" name="end_time" id="end_time" class="form-control">
           </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">End Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="End Time of Event"></i> </label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" id="end_time" name="end_time" />
                            <!-- <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
          </span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="table-csv">
            <div class="col-md-12">
               <label class="control-label cstm-label" style="font-weight: 600;">Would you like to register for the event?<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Deadline of registration"></i> </label>
                <input name='event_registration' id="event_registration" type='radio' value="yes" /> Yes
                <input name='event_registration' id="event_registration" type='radio' value="no" checked /> No
                <div class="row" id="show-me">
                    <div class="col-md-12">
                        <label class="control-label cstm-label" style="font-weight: 600;">Do you want to give the registration deadline?<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Deadline of registration"></i></label>
                        <input name='registration_deadline' id="registration_deadline" type='radio' value="1" /> Yes
                        <input name='registration_deadline' id="registration_deadline" type='radio' value="2" checked /> No
                    </div>
                </div>
                    <div class="row" id="show-me2">
                    <div class="col-md-6">
                        {{datebox($errors, '<label class="control-label">Date <i class="fas fa-info-circle" data-toggle="tooltip" title="End date of registration."></i></label>', 'reg_start_date')}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="End time of registration"></i> </label>
                            <div class='input-group date'>
                                <input type="text" id="reg_start_time" class="form-control" name="reg_start_time">
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    <div class="btn-wrap text-right">
        <button class="cstm-btn solid-btn">Next</button>
    </div>
</form>
<style type="text/css">
.input-group-addon:last-child {
    border-left: 0 !important;
}

.input-group-addon {
    padding: 6px 12px !important;
    font-size: 14px !important;
    font-weight: 400 !important;
    line-height: 1 !important;
    color: #555 !important;
    text-align: center !important;
    background-color: #eee !important;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
}

.input-group-addon,
.input-group-btn {
    width: 1% !important;
    white-space: nowrap !important;
    vertical-align: middle !important;
}

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
    line-height: 54px;
    width: 37px !important;
}

.bootstrap-datetimepicker-widget table td span {
    display: inline-block;
    width: 37px !important;
    height: 37px !important;
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
    display: flex !important;
    align-items: center;
    justify-content: center;
}

span.glyphicon.glyphicon-chevron-down {
    display: flex !important;
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

.Physical-seats-error {
    color: #c22 !important;
    font-weight: 400 !important;
    font-size: 12px;
    line-height: 1;
    margin-top: 3px;
}
.cstm-form-row {
  display: flex;
  flex-wrap: wrap;
}
.hideDiv{
    display: none;
}
</style>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$.noConflict();
jQuery(document).ready(function($) {

    $('#start_time').datetimepicker({
        format: 'LT'
    });
});
jQuery(document).ready(function($) {

    $('#end_time').datetimepicker({
        format: 'LT'
    });
});
jQuery(document).ready(function($) {

    $('#reg_start_time').datetimepicker({
        format: 'LT'
    });
});
$("#physical_seat, #virtual_seat,#max_person").on('focusout', function() {
var value2 = parseInt($("#virtual_seat").val()) > 0 ? parseInt($("#virtual_seat").val()) : 0;
var value1 = parseInt($("#physical_seat").val()) > 0 ? parseInt($("#physical_seat").val()) : 0;
var total =  parseInt($("#max_person").val()) > 0 ? parseInt($("#max_person").val()) : 0;
  var sumOfValues = value1 + value2;
  if (sumOfValues > total) {
    $('#virtual').show();
   $("#virtual").html("Physical and Virtual seats should not more than total seats.");
  }else{
     $('#virtual').hide();
  }
});
$('#table-csv').addClass('hideDiv');
     $(document).on('change','#event_type', function(){
      var event_id = $(this).val();
      if(event_id){
          $.ajax({
              type:'GET',
              url : "<?= url(route('user.event.getEventType')) ?>",
              data:{'event_id':event_id},
              contentType: "application/json; charset=utf-8",
              dataType: "Json",
              success:function(result){
                if(result.status == 'corporate')
                {
                    $('#table-csv').addClass('showDiv').removeClass('hideDiv');
                   
                }else{
                  $('#table-csv').addClass('hideDiv').removeClass('showDiv');
                  $('#event_payment').attr('style', 'display:none');
                }
                  
                 
              }
          }); 
      }
  });
$(document).ready(function() {
    var reg_deadline = $('#show-me');
    reg_deadline.hide();
$('input[name$="event_registration"]').change(function() 
{ 
    var inputData = $(this).attr("value"); 
    if (inputData == 'yes') 
    { 
        reg_deadline.show(); 
       $('#event_payment').attr('style', 'display:block');
    }else{ 
        reg_deadline.hide();
     $('#event_payment').attr('style', 'display:none');
        
    }
    });
});
$(document).ready(function() {
    var reg_date = $('#show-me2');
    reg_date.hide();
    $('input[name$="registration_deadline"]').change(function() 
    { 
        var inputData1 = $(this).attr("value"); 
        if (inputData1 == '1')
        { 
            reg_date.show(); 
             
        }else{ 
             
            reg_date.hide(); 
        } 
    });
});
</script>