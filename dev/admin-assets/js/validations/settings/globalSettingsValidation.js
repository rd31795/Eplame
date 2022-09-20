$(document).ready(function() {

     // UserEventForm
  $('#globalSettingsForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
       "gallery_expiration_time": { 
          required: true,
          digits: true,
          minlength : 1,
          maxlength :10
      },
      "admin_escrow_percentage": { 
          required: true,
          min: 1,
          max:99
      },
      "google_api_key": { 
          required: true,
      },
      "weather_api_key": { 
          required: true,
      },
      "taxjar_api_key": { 
          required: true,
      },
      "commission_fee_amount" :{
        required: true,
        amount: true,
        min: 1
      },
      "service_fee_amount" :{
        required: true,
        amount: true,
        min: 1
      },
      "contact_email" :{
         required: true,
          email: true
      },
      "alter_email" :{
          email: true
      },
      "address" :{
         required: true,
         maxlength: 100
      },
      "mobile" :{
         required: true,
         phoneUS: true,
         minlength:8,
         maxlength: 10
      },
      "phone_number":{
         required: true,
         phoneUS: true
      },
      "email_id":{
          email: true
      },
      "facebook_url":{
          maxlength: 100
      },
      "twitter_url":{
          maxlength: 100
      },
      "instagram_url":{
          maxlength: 100
      },
      "linkedin_url":{
          maxlength: 100
      },
      "skype":{
          maxlength: 100
      },
      "whatsapp_num":{
          maxlength: 100
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // UserEvent Submitting Form 
    $('#globalSettingsFormBtn').click(function()
    {
      if($('#globalSettingsForm').valid())
      {
        $('#globalSettingsFormBtn').prop('disabled', true);
        $('#globalSettingsForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
