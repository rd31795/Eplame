$(document).ready(function(){
   //  Form
	$('#maintenanceForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "page_title": { 
          required: true,
          maxlength: 100,
      },
      "description": { 
          required: true,
          maxlength: 200,
      }
    },
    });   
  
    //  Submitting Form 
    $('#maintenanceSbt').click(function()
    {
      if($('#maintenanceForm').valid())
      {
        $('#maintenanceSbt').prop('disabled', true);
        $('#maintenanceForm').submit();
      } else {
        return false;
      }
    });
    
});
