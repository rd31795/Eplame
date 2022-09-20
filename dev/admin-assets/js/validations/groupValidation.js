$(document).ready(function(){
   // Add Department Form
	$('#groupForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "group_label": { 
          required: true,
          alphanumeric: true,
          maxlength: 30,
      },
      "event_type_id": { 
          required: true
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#groupFormSbt').click(function()
    {
      if($('#groupForm').valid())
      {
        $('#groupFormSbt').prop('disabled', true);
        $('#groupForm').submit();
      } else {
        return false;
      }
    });
    
});
