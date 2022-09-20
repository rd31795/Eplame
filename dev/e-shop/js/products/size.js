   var url_string = window.location.href; //window.location.href
     var url = new URL(url_string);
     var c = url.searchParams.get("sizes");
     $(".filterType").on('click',(e)=>{
    const data={
      colors:$("input[name=colors]").val(),
      sizes:$("input[name=sizes]:checked").val(),
    }
    getVariantPriceView(data);
   });

   $( document ).ready(function() {
       $('#filter-sizes-'+c).click();
       let d={
           colors:$("input[name=colors]").val(),
           sizes:$("input[name=sizes]:checked").val(),
        }
      if(d.colors != undefined || d.sizes != undefined){
         getVariantPriceView(d);
      }
   });

function updateUrlParameter(param, value) {
    const regExp = new RegExp(param + "(.+?)(&|$)", "g");
    const newUrl = window.location.href.replace(regExp, param + "=" + value + "$2");
    window.history.replaceState("", "", newUrl);
}