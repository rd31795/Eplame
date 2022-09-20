let list_last=[];
 var IDs = $(".child_category input:checkbox:checked").map(function(){
       list_last.push($(this).val());
    }).get();   
 console.log(list_last);
$(".assign-category").on("click",(e)=>{
   var url=$("#categories").attr('data-url');	
   var Idslength = $(".child_category input:checkbox:checked").length;
   list_last.push(e.target.value);
   if (Idslength > $("#categories").attr('data-category') ){
       document.querySelector(`#featured_category_${list_last[list_last.length-2]}`).checked=false;
    }
     var IDs = $(".child_category input:checkbox:checked").map(function(){
      return $(this).val();
    }).get();
   $.ajax({
      url:url,
      data:{categories:IDs},
      success:function(data){
        console.log("success =>"+data);
      },
      error:function(data){
        console.log("errors =>"+data);
      }
   });
});

