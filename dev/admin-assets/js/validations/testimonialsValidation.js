$(document).ready(function(){
   // Add Department Form
	$('#testimonialForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "title": { 
          required: true,
          minlength: 2,
          maxlength: 30,
      },
      "summary":{
        required: true,
        maxlength: 150,
        minlength: 10,
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#testimonialFormSbt').click(function()
    {
      if($('#testimonialForm').valid())
      {
        $('#testimonialFormSbt').prop('disabled', true);
        $('#testimonialForm').submit();
      } else {
        return false;
      }
    });
    
});
