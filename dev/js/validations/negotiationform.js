$(document).ready(function(){
      $('#negoatiationForm').validate({
        onfocusout: function (valueToBeTested) {
          $(valueToBeTested).valid();
        },
      
        highlight: function(element) {
          $('element').removeClass("error");
        },
      
        rules: {
          "customer_email": {
            required: true,
            email: true
           },
          "coupon_code": {
            required: true,
            alphanumeric: true,
            maxlength: 10
          },
          "product":{
            required: true
          },
          "negotiation_discount_type":{
            required: true
          },
          "amount": {
            required: true,
            positiveNumber: true,
            minlength: 1,
            maxlength: function(element){
              // if Off type is Percent
                        if($('select[name="negotiation_discount_type"]').val() == 0){
                            return 2;
                        }
                        else{
                            return 5;
                        }
                    }
          },
          valueToBeTested: {
              required: true,
          }
        },
        });   
         $('#btnMenu').click(function() {
          if($('#negoatiationForm').valid()) {
            $('#btnMenu').prop('disabled', true);
            $('#negoatiationForm').submit();
          } else {
            return false;
          }
        });
        $.validator.addMethod('positiveNumber',
        function (value) { 
            return Number(value) > 0;
        }, 'Please enter a valid number.');
        
    });
    
    $('.product-list').change(function(){
        const value = $(this).val();
        $.ajax({
            url:"product-price",
            data:{product:value},
            success:function(result){
                console.log(result);
            }
        })
    });

    $('#coupon_code').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
             
          
        });

    $('#coupon_code').on('keyup',function(e){
         $.ajax({
              url:"check-coupon",
              data:{coupon_code:e.target.value,checkcoupon:true},
              error:function(result){
                console.log(result);
                if(result.responseJSON.errors.coupon_code){
                  $("label[for='coupon_code']").text(result.responseJSON.errors.coupon_code);
                  $("label[for='coupon_code']").css('display','block');
                }else{
                  $("label[for='coupon_code']").text('');
                }
              }
             });
    });

