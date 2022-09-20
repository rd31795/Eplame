
 $( document ).ready(function() {
  const url=new URL(window.location.href);
  const type=url.searchParams.get('type');
  if(type){
    $(`input[value=${type}]`).attr('checked',true);
  }
 });

loadProductListWithFilter();

//===============================================================================================================



function loadProductListWithFilter($v=0) {
	 var $this = $("body").find('form#ProductFilterOfSidebar');
     var $url = $this.attr('action');
     var $divPath = $("body").find('#loadProducts');
	 $.ajax({
               url : $url,
               data : $this.serialize(),
               type: 'POST',   
               dataTYPE:'JSON',
               headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').show()
               },
                beforeSend: function() {
                  
                    $("body").find('.custom-loading').show();
                  
                },
                success: function (result) {
                        if(parseInt(result.status) == 1){
                            $divPath.html(result.htm) ;

                              setTimeout(function() {
                                  $("body").find('.custom-loading').hide();
                              }, 3000);
                        }
               },
               complete: function() {
                        $("body").find('.custom-loading').hide();
               },
               error: function (jqXhr, textStatus, errorMessage) {
                     
               }

   });
}


//===============================================================================================================

jQuery("body").on('click','.resetRadio',function(){
          $this = $('input[name=price]:checked');
          if($this.is(':checked')) { 
              $this.prop('checked', false);
          } 

});


//===============================================================================================================

jQuery("body").on('click','.resetProductType',function(){
          $this = $('input[name=product-type]:checked');
          if($this.is(':checked')) { 
              $this.prop('checked', false);
          } 
          const href=new URL($("#ProductFilterOfSidebar").attr('action'));
          href.searchParams.delete('type');
          console.log(href.href);
          $("#ProductFilterOfSidebar").attr('action',href.href);
          loadProductListWithFilter(1);
});

jQuery("body").on('change','.product-type-value',function(e){ 
               const param_value=e.target.value;
               updateUrlParameter('type',param_value);
               const href=new URL($("#ProductFilterOfSidebar").attr('action'));
               href.searchParams.set('type',param_value);
               $("#ProductFilterOfSidebar").attr('action',href.href);
               loadProductListWithFilter(1);
   });
//===============================================================================================================
function updateUrlParameter(param, value){
    const regExp = new RegExp(param + "(.+?)(&|$)", "g");
    const newUrl = window.location.href.replace(regExp, param + "=" + value + "$2");
    window.history.replaceState("", "", newUrl);
}

$("body").on('change','.formInputFilter',function(){
loadProductListWithFilter(1);
});







































