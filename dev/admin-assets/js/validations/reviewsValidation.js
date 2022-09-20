$(document).ready(function(){
   // Add Department Form
	$('#reviewForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "rating": { 
          required: true
      },
      "title": { 
          required: true,
          minlength: 2,
          maxlength: 30,
      },
      "summary":{
        required: true,
        maxlength: 250,
        minlength: 10,
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#reviewFormSbt').click(function()
    {
      if($('#reviewForm').valid())
      {
        $('#reviewFormSbt').prop('disabled', true);
        $('#reviewForm').submit();
      } else {
        return false;
      }
    });
    
});
