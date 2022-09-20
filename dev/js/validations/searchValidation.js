$(document).ready(function() {

     // UserEventForm
  $('#SearchForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      
      // "start_date": {
      //   required: true
      // },
      "end_date": {
        required: true
      },
      
      "event_type[]":{
      	required: true
      },
      "vendors[]": {
        required: true
      },
      "location": {
        required: true
      },
      "latitude": {
        required: true,
      },
      "longitude": {
        required: true,
      },
      "guest_capacity": {
        required: true,
      },
      
       

      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // UserEvent Submitting Form 
    $('#searchFormBtn').click(function()
    {
      if($('#SearchForm').valid())
      {
        $('#searchFormBtn').prop('disabled', true);
        $('#SearchForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
