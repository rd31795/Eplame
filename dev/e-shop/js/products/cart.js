



// //==================================================================================================================
// //==================================================================================================================
// //==================================================================================================================




function checkNegotiationCoupon(buyNow = 0){
  if($("#negotiation_coupon")){
      const NegotiationCoupon=$("#negotiation_coupon").val();
      const $url=$("#negotiation_coupon").attr('data-url');
      if(NegotiationCoupon){
            console.log(NegotiationCoupon);
            $.ajax({
              url:$url,
              data:{coupon_code:NegotiationCoupon},
              dataTYPE:'JSON',
              headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').show()
              },
              success:function(result){
                if(result.success){
                  addToCartFunction(buyNow);
                }
                 $('#errorMessageBox').html(ErrorMsg('danger',result.message));              }
            });
      }else{
           addToCartFunction(buyNow);
      }
  }

}


function addToCartFunction(buyNow) {
	 var $this = $("body").find('form#ADDToCART');
    let data=$this.serialize() + "&buyNow=" + buyNow;
     var $url = $this.attr('data-action');
     var $divPath = $("body").find('#loadProducts');
	 $.ajax({
               url : $url,
               data : data,
               type: 'GET',   
               dataTYPE:'JSON',
               headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').show()
               },
                beforeSend: function() {
                   $("body").find('.custom-loading').show();
                   $this.find('.cartButton').attr('disabled','true');
                },
                success: function (result) {
                        if(parseInt(result.status) == 1){
                            $divPath.html(result.htm) ;

                                  $("body").find('.custom-loading').hide();
                                   $this.find('#errorMessageBox').html(ErrorMsg('success',result.messages));
                              setTimeout(function() {
                                  window.location.href=result.url;
                              }, 1000);
                        }else if(parseInt(result.status) == 0){
                        	  $this.find('#errorMessageBox').text(result.messages);
                              $this.find('.cartButton').removeAttr('disabled');

                        }
                         $('.cartButton').attr('disabled','false');
                         $('.buyNow').attr('disabled','false');
               },
               complete: function() {
                        $("body").find('.custom-loading').hide();
               },
               error: function (jqXhr, textStatus, errorMessage) {
                     
               }

   });
}







 function ErrorMsg(type,message){

      var txt  ='';
          txt +='<div class="alert alert-'+type+'" role="alert">';
          txt +=message;
          txt +='</div>';

          return txt;
  }






// $("body").on('click','.filterType',function(){

//      var $this = $("body").find('form#ADDToCART');
//      var $url = $this.attr('data-action');
//      var $divPath = $("body").find('#loadProducts');
//    $.ajax({
//                url : $url,
//                data : $this.serialize(),
//                type: 'GET',   
//                dataTYPE:'JSON',
//                headers: {
//                  'X-CSRF-TOKEN': $('input[name=_token]').show()
//                },
//                 beforeSend: function() {
//                    $("body").find('.custom-loading').show();
//                    $this.find('.cartButton').attr('disabled','true');
//                 },
//                 success: function (result) {
//                         if(parseInt(result.status) == 1){
//                             $divPath.html(result.htm) ;

//                                   $("body").find('.custom-loading').hide();
//                                    $this.find('#errorMessageBox').text(result.messages);
//                               setTimeout(function() {
//                                   window.location.reload();
//                               }, 3000);
//                         }else if(parseInt(result.status) == 0){
//                             $this.find('#errorMessageBox').text(result.messages);
//                               $this.find('.cartButton').removeAttr('disabled');

//                         }
//                },
//                complete: function() {
//                         $("body").find('.custom-loading').hide();
//                },
//                error: function (jqXhr, textStatus, errorMessage) {
                     
//                }

//    });

// });































