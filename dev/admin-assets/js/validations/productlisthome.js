$(document).ready(function(){
   //  Form
	$('#productlist_home_page').validate({
    onfocusout: function (valueToBeTested) {
      console.log(valueToBeTested);
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "heading": { 
          required: true,
          maxlength: 200
      },
      "allcategory[]":{
          required: true
      }
    },
    });   
    //  Submitting Form 
    $('#ProductList_home_FormBtn').click(function()
    {
      if($('#productlist_home_page').valid())
      {
        $('#ProductList_home_FormBtn').prop('disabled', true);
        $('#productlist_home_page').submit();
      } else {
        return false;
      }
    });
    
});
