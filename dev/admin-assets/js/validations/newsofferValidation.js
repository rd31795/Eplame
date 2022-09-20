$(document).ready(function(){
   // Faq Form
  $('#newsofferForm').validate({
  
    rules: {
      "detail": { 
          required: true,
          minlength: 5,
          maxlength: 200
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // faq Submitting Form 
    $('#newsofferBtn').click(function()
    {
      if($('#newsofferForm').valid())
      {
        $('#newsofferForm').prop('disabled', true);
        $('#faqForm').submit();
      } else {
        return false;
      }
    });
    
});
