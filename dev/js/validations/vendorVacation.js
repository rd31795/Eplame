$(document).ready(function() {

     // UserEventForm
  $('#vendorVacationForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      
      "start_date": {
        required: true,
        minDate: true
      },
      "end_date": {
        required: true,
        minStartDate: true
      }
    },
    });   
  
    // UserEvent Submitting Form 
    $('#VendorVacationBtn').click(function()
    {
      if($('#vendorVacationForm').valid())
      {
        $('#VendorVacationBtn').prop('disabled', true);
        $('#vendorVacationForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
