$(document).ready(function(){

$('.register-Submit').click(function() {
  if($('#registerVendorForm').valid()) {
    $('.register-Submit').prop('disabled', true);
    $('#registerVendorForm').submit();
  } else {
    return false;
  }
});

$('#registerVendorForm').validate({
onfocusout: function (valueToBeTested) {
  $(valueToBeTested).valid();
},

highlight: function(element) {
  $('element').removeClass("error");
},

rules: {
  
  'reference_business_name': {
      required: true
      
  },
  'reference_email': {
      required: true,
      customemail: true,
  },
  'reference_contact_number': {
       required: true,
       number: true,
  },
   
  'location': {
      required: true,
       
  },

  'website_url': {
      url: true,
  },

  'phone_number': {
      required: true,
      number: true,
      minlength: 10,
      maxlength: 14
  },

  'reference_contact_number': {
      
      number: true,
      minlength: 10,
      maxlength: 14
  },

  'ein_bs_number': {
      required: true,
      number: true,
      minlength:7,
      maxlength: 10
  },
  'age': {
      required: true,
      minAge: 18
  },
  'id_proof': {
      required: true,
      
  },
  'categories': {
      required: true,
      
  },
  "agree": {
    required: true
  },

  valueToBeTested: {
      required: true,
  }

},
});

$.validator.addMethod("character_with_space", function (value, element) {
  return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
  }, "Only letters are allowed.");

  //Email-Add-Method
  $.validator.addMethod("customemail", function (value, element) {
    return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
  }, "Please enter a valid email address.");  

  //Email-Add-Method
  $.validator.addMethod("customURL", function (value, element) {
    return this.optional(element) || /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/.test(value);
  }, "Please enter a valid URL or delete the http:// above to continue.");  

  //Alphanumeric-Add-Method
  $.validator.addMethod("alphanumeric", function (value, element) {
    return this.optional(element) || /^[a-z\d\-_\s]+$/i.test(value);
  }, "Please enter alpha-numeric characters only.");   

  //Alphanumeric-Special-Character-Add-Method
  $.validator.addMethod("alphanumeric_special_character", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9?=.*!@#$%^',&*_\-\s]+$/i.test(value);
  }, "Please enter alpha-numeric or special characters only.");  


  $.validator.addMethod("phoneUS", function (value, element) {
  return this.optional(element) || value == value.match(/^(?=.*[0-9])[- +()0-9]+$/);
}, "Please specify a valid phone number.");  

});  

