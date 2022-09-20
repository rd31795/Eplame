
$(document).ready(function(){
   // billing Form
  $('#billingFormReg').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "first_name": {
          required: true,
          alphanumeric: true
      },
      "email": {
          required: true,
          email: true
      },
      "mobile": {
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
      "reg_type":{
        required: true
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // billing Form Submitting 
    $('#billingFormBtnReg').click(function() {
      if($('#billingFormReg').valid()) {
        $('#billingFormBtnReg').prop('disabled', true);
        $('#billingFormReg').submit();
      } else {
        return false;
      }
    });






//######################################################################################################


$("body").on('submit','#billingFormReg',function(e){
     e.preventDefault();
     var $this = $( this );

     $.ajax({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: $this.attr('action'),
          type: "POST",
          dataType: "JSON",
          data: $this.serialize(),
          beforeSend: function() {
          jQuery("body").find('.custom-loading').show();
          },   
          success: function(res) {
             if(res.status == 1) {
                    //alert("error");
                    setTimeout(function() {
                       $('#messages').text(res.errors);
                    }, 3000);


                   $('#billingFormBtnReg').removeAttr('disabled');
                    window.location.href = res.redirectLink;
             }else{

                   $('#billingFormBtnReg').removeAttr('disabled');
                        $('#messages').html(erorrMessage(res.errors));
                    setTimeout(function() {
                        $('#messages').html('');
                    }, 3000);

             }

             
              
             
          }, 
          error: function(err) {
           
              $('#err_show').show();
                $('#err_mess').html(JSON.parse(err.responseText).message);

                setTimeout(function() {
                  $('#err_show').fadeOut('smooth');
                }, 3000);
          },
          complete: function() {
             $('#couponFormBtn').prop('disabled', false);
          jQuery("body").find('.custom-loading').hide();
         }
      });
});













 function ErrorMsg(type,message){

      var txt  ='';
          txt +='<div class="alert alert-'+type+'" role="alert">';
          txt +=message;
          txt +='</div>';

          return txt;
  }


/*----------------------------------------------------------------------------
|
|   Business filter
|_____________________________________________________________________________
*/

function erorrMessage(errors) {

      var txt ="";
      $.each(errors, function( index, value ) {
        txt += ErrorMsg('warning',value);
          
      });
      return txt;
}

//######################################################################################################
//    start
//######################################################################################################



    
});
