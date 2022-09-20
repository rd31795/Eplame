$(document).ready(function() {

     // UserEventForm
  $('#video_upload_form').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "video_url": {
        isembedUrl : true,
        required : true
      },

      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // UserEvent Submitting Form
    $('#video_upload_formBtn').click(function()
    {
      if($('#video_upload_form').valid())
      {
        $('#video_upload_formBtn').prop('disabled', true);
        $('#video_upload_form').submit();
      } else {
        return false;
      }
    });
    
});

$.validator.addMethod('isembedUrl', function(s, element){
  var regexp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/
  return this.optional(element) || regexp.test(s)
}, 'Please enter Valid Url');