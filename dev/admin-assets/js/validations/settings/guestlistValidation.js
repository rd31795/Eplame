$(document).ready(function(){
   // HomePage Form
	$('#guestlistForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "guest_list_title": {
          required: true,
          maxlength: 100,
      },
      "guest_list_tagline": {
          required: true,
          maxlength: 100,
      },
      "guest_list_video_title": {
          required: true,
          maxlength: 100,
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // HomePage Submitting Form 
    $('#guestlistFormBtn').click(function()
    {
      if($('#guestlistForm').valid())
      {
        $('#guestlistFormBtn').prop('disabled', true);
        $('#guestlistForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
