$(document).ready(function(){
   // package Form
  $("body").find('#firstRegistration').validate({
     ignore: [],
	    onfocusout: function (valueToBeTested) {
	      $(valueToBeTested).valid();
	    },
  
	    highlight: function(element) {
	      $('element').removeClass("error");
	    },
 
  
    rules: {
      "first_name": {
        required: true,
        alphanumeric: true,
        maxlength: 30
      },
      
      "last_name": {
        required: true,
        alphanumeric: true,
        maxlength: 30
      },
        "mobile": {
        required: true,
        digits: true,
        minlength: 10,
        maxlength: 10
      },
       "email": {
        required: true,
        email: true
      },
      "age": {
        required: true
      },
      "gender": {
        required: true
      },
      "group": {
        required: true
      },
      "menu": {
        required: true
      },
      "reg_type":{
        required: true
      },
       
       
      valueToBeTested: {
          required: true,
      }
    }
});   
  


$("body").on('click','.btn-back-step',function(e){
  $("body").find('.custom-loading').show();
  var $this = $( this ).attr('data-action');
  var backStep = $( this ).attr('data-step');
    $("body").find('.step1').hide();
    $("body").find('.step2').hide();
     $("body").find('.step3').hide();
    $("body").find('.'+$this).show();
    
    setprogressBar(backStep);
    $("body").find('.custom-loading').hide();
  
});

$("body").find('.step1').show();
$("body").find('.step2').hide();
$("body").find('.step3').hide();

//CKEDITOR.replace('long_description');
  



  $("body").find('#secondEventCreate').validate({
     ignore: [],
      onfocusout: function (valueToBeTested) {
        $(valueToBeTested).valid();
      },
  
      highlight: function(element) {
        $('element').removeClass("error");
      },
 
  
    rules: {
     
      valueToBeTested: {
          required: true,
      }
    }
}); 

  $("body").find('#thirdEventCreate').validate({
     ignore: [],
      onfocusout: function (valueToBeTested) {
        $(valueToBeTested).valid();
      },
  
      highlight: function(element) {
        $('element').removeClass("error");
      },
 
  
    rules: {
     
      valueToBeTested: {
          required: true,
      }
    }
}); 











$("body").on('submit','#firstRegistration',function(e){
       e.preventDefault();
       var $this = $( this );
       $("body").find('.custom-loading').show();
 
     if($( this ).valid()){

         localStorage.setItem("event_id", $this.find('#event_id').val());
         localStorage.setItem("first_name", $this.find('#first_name').val());
         localStorage.setItem("last_name", $this.find('#last_name').val());
         localStorage.setItem("email", $this.find('#email').val());
         localStorage.setItem("mobile", $this.find('#mobile').val());
         localStorage.setItem("age", $this.find('#age').val());
         localStorage.setItem("gender", $this.find('#gender').val());
         localStorage.setItem("group", $this.find('#group').val());
         localStorage.setItem("menu", $this.find('#menu').val());


     	  $("body").find('.step1').hide();
     	  $("body").find('.step2').show();
        $("body").find('.step3').hide();
         setprogressBar(2);
         setAllInputIntoOneForm();
     }
     $("body").find('.custom-loading').hide();

});

$("body").on('submit','#thirdEventCreate',function(e){
       e.preventDefault();
       var $this = $( this );
       $("body").find('.custom-loading').show();
 
    

        $("body").find('.step1').hide();
        $("body").find('.step2').hide();
        $("body").find('.step3').show();
         setprogressBar(2);
         setAllInputIntoOneForm();

     $("body").find('.custom-loading').hide();

});






$("body").on('submit','#secondEventCreate',function(e){
      e.preventDefault();
     var $this = $( this );

     if($( this ).valid()){
        
             var formData = new FormData(this);
             console.log(formData);

             // var yourArray = getAllCategoryCheckedForEvent();
             // formData.append('event_categories',yourArray);


           $.ajax({
              url: $this.attr("action"),
              type: 'POST',
              data: formData,
              dataTYPE:'JSON',
              beforeSend: function() {
                    $("body").find('.custom-loading').hide();
                     
              },
              success: function (data) {
                console.log(data);
                   if(data.status == 1){
                        //window.location.href= data.url;
                        //$("body").find('.custom-loading').show();
                        $("body").find('.step1').hide();
                        $("body").find('.step2').hide();
                        $("body").find('.step3').show();
                        // $('#message').html('<div class="alert alert-success">You have registered successfully</div>');
                   }else{
                    $("body").find('.custom-loading').hide();
                    alert(data.errors);
                   }

              },
              cache: false,
              contentType: false,
              processData: false
          });
     }

});






function getAllCategoryCheckedForEvent(argument) {
  var yourArray =[];
  $("body").find("input:checkbox[class=categoryCheckboxes]:checked").each(function(){
        yourArray.push($(this).val());
  

  });
    
     return yourArray;
}




 
 




//-------------------------------------------------------------------------------------------------



function setAllInputIntoOneForm() {
          var fort_event_id = localStorage.getItem("event_id");
         var fort_first_name = localStorage.getItem("first_name");
         var fort_last_name = localStorage.getItem("last_name");
         var fort_email = localStorage.getItem("email");
         var fort_mobile = localStorage.getItem("mobile");
          var fort_age =localStorage.getItem("age");
          var fort_gender = localStorage.getItem("gender");
          var fort_group = localStorage.getItem("group");
         var fort_menu =  localStorage.getItem("menu");

         var $this = $("body").find('#secondEventCreate');

         $this.find('#fort_event_id').val(fort_event_id);
         $this.find('#fort_first_name').val(fort_first_name);
         $this.find('#fort_last_name').val(fort_last_name);
         $this.find('#fort_email').val(fort_email);
         $this.find('#fort_mobile').val(fort_mobile);
         $this.find('#fort_age').val(fort_age);
         $this.find('#fort_gender').val(fort_gender);
         $this.find('#fort_group').val(fort_group);
         $this.find('#fort_menu').val(fort_menu);

}








//----------------------------------------------------------------------------------------------------





function formModalSubmit(argument) {
           
          $.ajax({
              url: window.location.pathname,
              type: 'POST',
              data: formData,
              success: function (data) {
                  alert(data)
              },
              cache: false,
              contentType: false,
              processData: false
          });
        
}









//------------------------------------------------------------------------------

function setprogressBar(val) {
    if(parseInt(val) == 1){
        $("body").find('li.stp-1').addClass('active');
        $("body").find('li.stp-2').removeClass('active');
        $("body").find('li.stp-3').removeClass('active');
        $("body").find('li.stp-4').removeClass('active');
        $("body").find('li.stp-5').removeClass('active');
    }

     if(parseInt(val) == 2){
        $("body").find('li.stp-1').addClass('active');
        $("body").find('li.stp-2').addClass('active');
        $("body").find('li.stp-3').removeClass('active');
        $("body").find('li.stp-4').removeClass('active');
        $("body").find('li.stp-5').removeClass('active');
    }

     if(parseInt(val) == 3){
        $("body").find('li.stp-1').addClass('active');
        $("body").find('li.stp-2').addClass('active');
        $("body").find('li.stp-3').addClass('active');
        $("body").find('li.stp-4').removeClass('active');
        $("body").find('li.stp-5').removeClass('active');
    }

     if(parseInt(val) == 4){
        $("body").find('li.stp-1').addClass('active');
        $("body").find('li.stp-2').addClass('active');
        $("body").find('li.stp-3').addClass('active');
        $("body").find('li.stp-4').addClass('active');
        $("body").find('li.stp-5').removeClass('active');
    }

     if(parseInt(val) == 5){
        $("body").find('li.stp-1').addClass('active');
        $("body").find('li.stp-2').addClass('active');
        $("body").find('li.stp-3').addClass('active');
        $("body").find('li.stp-4').addClass('active');
        $("body").find('li.stp-5').addClass('active');
    }
}










    
    
});





































