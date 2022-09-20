$(document).ready(function(){
   // Add Department Form
	$('#forumgroupForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "label": { 
          required: true,
          alphanumeric: true,
          maxlength: 30,
      },
      "description":{
        required: true,
        maxlength: 250,
        minlength: 10,
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#forumgroupFormSbt').click(function()
    {
      if($('#forumgroupForm').valid())
      {
        $('#forumgroupFormSbt').prop('disabled', true);
        $('#forumgroupForm').submit();
      } else {
        return false;
      }
    });
    
});
