$(document).ready(function(){
   // CmsPage Form
  $('#ThankyouTemplateForm').validate({
     ignore: [],
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },

    errorPlacement: function(error, element) {
      if (element.attr("name") == "body") {
        error.insertAfter("#cke_body");
      } else {
         error.insertAfter(element);
      }
    },
  
    rules: {
      "title": { 
          required: true,
          minlength: 2,
          maxlength: 50
      },
      "description": { 
          required: true,
          minlength: 2,
          maxlength: 250
      }
    },
    });   
  
    // CmsPage Submitting Form 
    $('#ThankyouTemplateFormBtn').click(function()
    {
      if($('#ThankyouTemplateForm').valid())
      {
        $('#ThankyouTemplateFormBtn').prop('disabled', true);
        $('#ThankyouTemplateForm').submit();
      } else {
        return false;
      }
    });
    
});
