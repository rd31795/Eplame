$(document).ready(function(){
   // HomePage Form
	$('#budgetForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "budget_title": {
          required: true,
          maxlength: 100,
      },
      "budget_tagline": {
          required: true,
          maxlength: 100,
      },
      "video_title": {
          required: true,
          maxlength: 100,
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // HomePage Submitting Form 
    $('#budgetFormBtn').click(function()
    {
      if($('#budgetForm').valid())
      {
        $('#budgetFormBtn').prop('disabled', true);
        $('#budgetForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
