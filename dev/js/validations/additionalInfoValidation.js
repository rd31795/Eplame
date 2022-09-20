$(document).ready(function(){
   // description Form
  $('#additionalInfoForm').validate({
     ignore: [],
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },

    errorPlacement: function(error, element) {
      if (element.attr("name") == "detail") {
        error.insertAfter("#cke_detail");
      } else {
         error.insertAfter(element);
      }
    },
  
    rules: {
      "detail": {
        ckrequired: true,
      },
      "label": {
        required: true,
        minlength: 2,
        maxlength: 40
      },
      // "days":{
      //   required: true,
      // },
      // "percentage":{
      //   required: true,
      // },
     


      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // description Form Submitting 
    $('#additionalInfoFormBtn').click(function() {
      if($('#additionalInfoForm').valid()) {
        $('#additionalInfoFormBtn').prop('disabled', true);
        $('#additionalInfoForm').submit();
      } else {
        return false;
      }
    });
    
});
