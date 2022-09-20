$(document).ready(function(){
   // Add Department Form
	$('#ProductPackageForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "title": { 
          required: true,
          minlength: 2,
          maxlength: 50,
      },
      "featured_summary":{
        required: true,
      },
      "package_price":{
        required:true,
        min:1
      },
      "package_validity":{
        required:true,
        min:1
      },
      "package_type" :{
        required:true 
      },
      "category_count" :{
        required:true,
        min:1,
        max:20
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#ProductPackageFormSbt').click(function()
    {
      if($('#ProductPackageForm').valid())
      {
        $('#ProductPackageFormSbt').prop('disabled', true);
        $('#ProductPackageForm').submit();
      } else {
        return false;
      }
    });
    
});
