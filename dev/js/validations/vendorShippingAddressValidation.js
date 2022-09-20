$('#shippingForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      // "name": {
      //     required: true,
      //     alphanumeric: true
      // },
      // "email": {
      //     required: true,
      //     email: true
      // },
      "phone_number": {
          required: true,
          phoneUS: true
      },
      "address": {
          required: true,
      },
      "country": {
          required: true,
      },
      "state": {
          required: true,
      },
      "city": {
          required: true,
      },
      "zipcode": {
          required: true,
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   