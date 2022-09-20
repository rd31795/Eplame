$(document).ready(function() {
 jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value.indexOf(" ") < 0; 
    }, "Space are not allowed");
     // UserEventForm
  $('#ContactForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
   
    rules: {
      "firstname": {
        lettersonly: true,
        required: true,
        minlength: 2,
        maxlength: 50,
        noSpace: true
      },
      "lastname": {
        lettersonly: true,
        maxlength: 50,
        noSpace: true
      },
       "email": {
         required: true,
          email: true 
      },
       "phone": {
         required: true,
         phoneUS: true,
         minlength: 8,
         maxlength: 12,
         noSpace: true
      },
      "message": {
         maxlength: 250
      },    

      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // UserEvent Submitting Form 
    $('#ContactFormBtn').click(function()
    {
      if($('#ContactForm').valid())
      {
        $('#ContactFormBtn').prop('disabled', true);
        $('#ContactForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
