$(document).ready(function(){
   //  Form
	$('#SliderBannerForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "banner_image": { 
          required: true,
      },
    },
    });   
    //  Submitting Form 
    $('#SliderFormBtn').click(function()
    {
      if($('#SliderBannerForm').valid())
      {
        $('#SliderFormBtn').prop('disabled', true);
        $('#SliderBannerForm').submit();
      } else {
        return false;
      }
    });
    
});
