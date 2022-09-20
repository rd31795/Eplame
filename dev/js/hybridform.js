$(document).ready(function(){
   // package Form
  $("body").find('#firstEventCreate').validate({
     ignore: [],
	    onfocusout: function (valueToBeTested) {
	      $(valueToBeTested).valid();
	    },
  
	    highlight: function(element) {
	      $('element').removeClass("error");
	    },
 
  
    rules: {
      "title": {
        required: true,
        alphanumeric: true,
        maxlength: 30
      },
      "event_type": {
        required: true 
      },
      
      "description": {
        required: true,
      },
       "physical_seat": {
        required: true,
        digits: true,
        minlength: 1,
        maxlength: 10
      },
       "virtual_seat": {
        required: true,
        digits: true,
        minlength: 1,
        maxlength: 10
      },
        "max_person": {
        required: true,
        digits: true,
        min: 1,
        minlength: 1,
        maxlength: 10
        // minPerson: true,
        // minlength: 1,
        // maxlength: 10
      },
       "start_date": {
        required: true,
        minDate: true
      },
      "end_date": {
        required: true,
        minStartDate: true
      },
      "start_time": {
        required: true,
         
      },
      "end_time": {
        required: true,
         
      },
      "location": {
        required: true,
      },
      
      // "reg_start_time": {
      //   required: true,
      // },
      valueToBeTested: {
          required: true,
      }
    }
  //   submitHandler: function(form){
  //   var total = parseInt($("#phappy").val()) + parseInt($("#puhappy").val()); 
  //   if (total != 100) {
  //     $("#commentForm div.error").html("Your percantage fields must sum to 100.")
  //     return false;
  //   } else form.submit();
  // }
});   
  
 


 $("body").find('#secondEventCreate').validate({
     ignore: [],
	    onfocusout: function (valueToBeTested) {
	      $(valueToBeTested).valid();
	    },
  
	    highlight: function(element) {
	      $('element').removeClass("error");
	    },
 
  
    rules: {
      
     "categories": {
        required: true
        
      },
      valueToBeTested: {
          required: true,
      }
    },
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
    	"style_type": {
        required: true, 
      },
      "style_image": {
        required: function(element){
            return $("#style_type").val()=="0";
        },
      },
      "style_title": {
        required: function(element){
            return $("#style_type").val()=="0";
        },
        maxlength: 50
      },
      "style_description": {
        maxlength: 200,
      },
       "banner_image": {
        required: true,
      },
       "event_picture": {
        required: true,
      },
      "media": {
        required: true,
      },
       "template_id": {
        required: true,
      },
      "colourNames[]": {
      //  lengthRequired: 'colourNames',
        colourMaxLength: 'colourNames'
      },
       "colours[]": {
      //  lengthRequired: 'colours',
        colourMaxLength: 'colours'
      },
      "event_budget": {
        required: true,
        number:true
         
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
    $("body").find('.step4').hide();
    $("body").find('.step5').hide();
    $("body").find('.'+$this).show();
    
    setprogressBar(backStep);
    $("body").find('.custom-loading').hide();
  
});

$("body").find('.step1').show();
$("body").find('.step2').hide();
$("body").find('.step3').hide();
$("body").find('.step4').hide();
$("body").find('.step5').hide();

//CKEDITOR.replace('long_description');
   


// $('#start_time').clockface();
// $('#end_time').clockface();

 

// $("body").on('change','#get',function(){
//      var val = $( this ).val();
//      $("body").find("#colour").val(val);
// });

// $("body").find('#forthEventCreate').validate({
//      ignore: [],
//       onfocusout: function (valueToBeTested) {
//         $(valueToBeTested).valid();
//       },
  
//       highlight: function(element) {
//         $('element').removeClass("error");
//       },
 
  
//     rules: {
//       "event_budget": {
//         required: true,
//         number:true
         
//       },
//       "long_description": {
//         required: true,
//         minlength: 5,
//         maxlength: 500
//       },
      
//       valueToBeTested: {
//           required: true,
//       }
//     }
// });   



// $("body").find('#fiveEventCreate').validate({
//      ignore: [],
//       onfocusout: function (valueToBeTested) {
//         $(valueToBeTested).valid();
//       },
  
//       highlight: function(element) {
//         $('element').removeClass("error");
//       },
 
  
//     rules: {
//       "style_type": {
//         required: true 
//       },
//       "style_image": {
//         required: function(element){
//             return $("#style_type").val()=="0";
//         },
//       },
//       "style_title": {
//         required: function(element){
//             return $("#style_type").val()=="0";
//         },
//         maxlength: 50
//       },
//       "style_description": {
//         maxlength: 200
//       },
//       "ideas": {
//         required: true,
//       },
            
//       "colourNames[]": {
//       //  lengthRequired: 'colourNames',
//         colourMaxLength: 'colourNames'
//       },
//        "colours[]": {
//       //  lengthRequired: 'colours',
//         colourMaxLength: 'colours'
//       },

//       "notepad": {
//         required: true,
//       },
//       "agree": {
//         required: true,
//       },

//       "event_picture": {
//         required: true,
//       },
      
//       valueToBeTested: {
//           required: true,
//       }
//     }
// });   





$("body").on('submit','#firstEventCreate',function(e){
       e.preventDefault();
       var $this = $( this );
       $("body").find('.custom-loading').show();
 
     if($( this ).valid()){


         localStorage.setItem("title", $this.find('#title').val());
         localStorage.setItem("event_type", $this.find('#event_type').val());
         localStorage.setItem("description", $this.find('#description').val());
         localStorage.setItem("start_date", $this.find('#start_date').val());
         localStorage.setItem("start_time", $this.find('#start_time').val());
         localStorage.setItem("end_date", $this.find('#end_date').val());
         localStorage.setItem("end_time", $this.find('#end_time').val());
         localStorage.setItem("location", $this.find('#location').val());
         localStorage.setItem("latitude", $this.find('#latitude').val());
         localStorage.setItem("longitude", $this.find('#longitude').val());
         localStorage.setItem("max_person", $this.find('#max_person').val());
         localStorage.setItem("physical_seat", $this.find('#physical_seat').val());
         localStorage.setItem("virtual_seat", $this.find('#virtual_seat').val());
         localStorage.setItem("event_registration", $this.find('.event_registration:checked').val());
         localStorage.setItem("reg_start_date", $this.find('#reg_start_date').val());
         localStorage.setItem("reg_start_time", $this.find('#reg_start_time').val());
         localStorage.setItem("event", $this.find('#event').val());


     	  $("body").find('.step1').hide();
     	  $("body").find('.step2').show();
         setprogressBar(2);
         setAllInputIntoOneForm();
     }
     $("body").find('.custom-loading').hide();

});



//------------------------------------------------------------------------------

$("body").on('submit','#secondEventCreate',function(e){
       e.preventDefault();
     var $this = $( this );
     $("body").find('.custom-loading').show();
     if($( this ).valid()){
        var yourArray = getAllCategoryCheckedForEvent();
           if(parseInt(yourArray.length) > 0){
         $("body").find('.step1').hide();
         $("body").find('.step2').hide();
         $("body").find('.step3').show();
         $("body").find('.step4').hide();
         $("body").find('.step5').hide();
         setAllInputIntoOneForm();
         setprogressBar(3);
         }else{
              $this.find('.messages').text('The categories is required.');
            }
            console.log( localStorage.getItem("categories"));
     }
     $("body").find('.custom-loading').hide();

});



//############################################################################################




$("body").on('submit','#thirdEventCreate',function(e){

      e.preventDefault();
     var $this = $( this );
        var seats_assigned=0;
      document.querySelectorAll(".reg_ticket_seat").forEach((val)=>{ seats_assigned+=parseInt(val.value); });
      var seats_available=$("#physical_seat_available").val();
      seats_assigned=seats_assigned?seats_assigned:0;
            if(seats_available<seats_assigned){
            $(".available_seats").html("<strong>Seats Limit Exceed</strong>");
             $(".available_seats").addClass('limit_exceed');
         return;
      }

      if(seats_available>seats_assigned){
          var seats=parseInt(seats_available)-seats_assigned;
          $(".available_seats").html("<strong>Please fill all seats. Available seats are : "+seats+"</strong>");
           $(".available_seats").addClass('limit_exceed');
        return ;
      }

     if($( this ).valid()){
        
             var formData = new FormData(this);
             var yourArray = getAllCategoryCheckedForEvent();
             formData.append('event_categories',yourArray);


           $.ajax({
              url: $this.attr("action"),
              type: 'POST',
              data: formData,
              dataTYPE:'JSON',
              beforeSend: function() {
                    $("body").find('.custom-loading').show();
                     
              },
              success: function (data) {
                console.log(data);
                   if(data.status == 1){
                        window.location.href= data.url;
                        $("body").find('.custom-loading').hide();
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






//############################################################################################




// $("body").on('submit','#forthEventCreate',function(e){
//        e.preventDefault();
//      var $this = $( this );

//      if($( this ).valid()){
//          localStorage.setItem("long_description", $this.find('#long_description').val());
//          localStorage.setItem("event_budget", $this.find('#event_budget').val());

//                  $("body").find('.step1').hide();
//                  $("body").find('.step2').hide();
//                  $("body").find('.step3').hide();
//                  $("body").find('.step4').hide();
//                  $("body").find('.step5').show();
//                  $this.find('.messages').text('');
//                  setAllInputIntoOneForm();
//                  setprogressBar(5);
//      }

// });







//############################################################################################









// $("body").on('submit','#fiveEventCreate',function(e){
//        e.preventDefault();
//      var $this = $( this );

//      if($( this ).valid()){
        
//              var formData = new FormData(this);
//              var yourArray = getAllCategoryCheckedForEvent();
//              formData.append('event_categories',yourArray);


//        	   $.ajax({
//               url: $this.attr("action"),
//               type: 'POST',
//               data: formData,
//               dataTYPE:'JSON',
//               beforeSend: function() {
//                     $("body").find('.custom-loading').show();
                     
//               },
//               success: function (data) {
                
//                    if(data.status == 1){
//                         window.location.href= data.url;
//                         $("body").find('.custom-loading').hide();
//                    }else{
//                     $("body").find('.custom-loading').hide();
//                     alert(data.errors);
//                    }

//               },
//               cache: false,
//               contentType: false,
//               processData: false
//           });
//      }

// });









function getAllCategoryCheckedForEvent(argument) {
  var yourArray =[];
  $("body").find("input:checkbox[class=categoryCheckboxes]:checked").each(function(){
        yourArray.push($(this).val());
  

  });
    
     return yourArray;
}




 
 







$("body").on('change','#event_type',function() {
   var $this = $(this);
    const selectedEvent = $(this).val();

    var url = $this.attr('data-action');
     
     $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:url,
        type: "get",
        dataType: "JSON",
        data: { '_token': $('meta[name="csrf-token"]').attr('content'), 'id': selectedEvent },
        success: function(res)
        { 
           
          if(res == '')
          {
            $("body").find('#all-services').html('<div class="col-lg-12"><div class="vendor-category" style="color:red;">Sorry! No Vendor Service available.</div></div>'); 
          }else{
          $("body").find('#all-services').html(res); 
          }
          
        },
        error: function(err) {
            console.log(err);
        }
    });
});









//-------------------------------------------------------------------------------------------------



function setAllInputIntoOneForm() {
          var fort_event_type = localStorage.getItem("event_type");
         var fort_event = localStorage.getItem("event");
         var fort_title = localStorage.getItem("title");
         var fort_description = localStorage.getItem("description");
         var fort_start_date = localStorage.getItem("start_date");
         var fort_start_time = localStorage.getItem("start_time");
         var fort_end_date = localStorage.getItem("end_date");
         var fort_end_time = localStorage.getItem("end_time");
         var fort_location = localStorage.getItem("location");
         var fort_latitude = localStorage.getItem("latitude");
         var fort_longitude = localStorage.getItem("longitude");
         var fort_event_picture = localStorage.getItem("event_picture");
         var fort_max_person = localStorage.getItem("max_person");
         var fort_physical_seat = localStorage.getItem("physical_seat");
         var fort_virtual_seat = localStorage.getItem("virtual_seat");
         var fort_event_registration = localStorage.getItem("event_registration");
         var fort_reg_start_date = localStorage.getItem("reg_start_date");
         var fort_reg_start_time = localStorage.getItem("reg_start_time");
         var fort_reg_type = localStorage.getItem("reg_type");
         var fort_price = localStorage.getItem("price");
         var fort_capacity = localStorage.getItem("capacity");


         var $this = $("body").find('#thirdEventCreate');

         $this.find('#fort_event_type').val(fort_event_type);
         $this.find('#fort_event').val(fort_event);
         $this.find('#fort_title').val(fort_title);
         $this.find('#fort_description').val(fort_description);
         $this.find('#fort_start_date').val(fort_start_date);
         $this.find('#fort_start_time').val(fort_start_time);
         $this.find('#fort_end_date').val(fort_end_date);
         $this.find('#fort_end_time').val(fort_end_time);
         $this.find('#fort_location').val(fort_location);
         $this.find('#fort_latitude').val(fort_latitude);
         $this.find('#fort_longitude').val(fort_longitude);
         $this.find('#fort_event_picture').val(fort_event_picture);
         $this.find('#fort_max_person').val(fort_max_person);
         $this.find('#fort_physical_seat').val(fort_physical_seat);
         $this.find('#physical_seat_available').val(fort_physical_seat);
         $this.find('#fort_virtual_seat').val(fort_virtual_seat);
         $this.find('#fort_event_registration').val(fort_event_registration);
         $this.find('#fort_reg_start_date').val(fort_reg_start_date);
         $this.find('#fort_reg_start_time').val(fort_reg_start_time);
         $this.find('#fort_reg_type').val(fort_reg_type);
         $this.find('#fort_price').val(fort_price);
         $this.find('#fort_capacity').val(fort_capacity);





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



  $('#corporate_team_members').hide();

  $('.teamMembersAddOrNot').change(function(){ 
    var current_val = $(this).val();
    if(current_val == 'yes'){
      var addMember = '<div class="memberClass"><div class="persn_head_sec"><h4>Add Person Details</h4><span class="remove_person_det"><i class="fas fa-user-times"></i></span></div><div class="form-group"><label class="control-label">Name <i class="fas fa-info-circle" data-toggle="tooltip" for="person_name_1" title="Name"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_name[]" id="person_name_1" placeholder="Name"></div><div class="form-group"><label class="control-label">Title <i class="fas fa-info-circle" data-toggle="tooltip" for="person_title_1" title="Title"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_title[]" id="person_title_1" placeholder="Title"></div><div class="form-group"><label class="control-label">Image <i class="fas fa-info-circle" data-toggle="tooltip" for="person_image_1" title="Image"></i></label><div class="input-field-wrap"><input type="file" class="form-control" name="person_image[]" id="person_image_1" placeholder="Image"></div><div class="form-group"><label class="control-label">Short Description <i class="fas fa-info-circle" data-toggle="tooltip" for="person_short_desc_1" title="Short Description"></i></label><div class="input-field-wrap"><textarea class="form-control myTextEditor" id="person_short_desc_1" name="person_short_desc[]" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea></div></div>';

      $('#teamMemberListing').html(addMember);
      $('#corporate_team_members').show();
    }else{
      $('#corporate_team_members').hide();
      $('#teamMemberListing').html('');
    }
  });


  $(document).on('click','.remove_person_det', function(){
    $(this).closest('.memberClass').remove();
  });

  $('#addTeamMembers').click(function(){ 
    var teamMemberListing = $('#teamMemberListing').html();
    console.log("teamMemberListing", teamMemberListing);
    if(teamMemberListing == ''){

      var addMember = '<div class="memberClass"><div class="persn_head_sec"><h4>Add Person Details</h4><span class="remove_person_det"><i class="fas fa-user-times"></i></span></div><div class="form-group"><label class="control-label">Name <i class="fas fa-info-circle" data-toggle="tooltip" for="person_name_1" title="Name"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_name[]" id="person_name_1" placeholder="Name"></div><div class="form-group"><label class="control-label">Title <i class="fas fa-info-circle" data-toggle="tooltip" for="person_title_1" title="Title"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_title[]" id="person_title_1" placeholder="Title"></div><div class="form-group"><label class="control-label">Image <i class="fas fa-info-circle" data-toggle="tooltip" for="person_image_1" title="Image"></i></label><div class="input-field-wrap"><input type="file" class="form-control" name="person_image[]" id="person_image_1" placeholder="Image"></div><div class="form-group"><label class="control-label">Short Description <i class="fas fa-info-circle" data-toggle="tooltip" for="person_short_desc_1" title="Short Description"></i></label><div class="input-field-wrap"><textarea class="form-control myTextEditor" id="person_short_desc_1" name="person_short_desc[]" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea></div></div>';

      $('#teamMemberListing').html(addMember);
    }else{

      var rec_length = $('.memberClass').length + 1;

      var addMember = '<div class="memberClass"><div class="persn_head_sec"><h4>Add Person Details</h4><span class="remove_person_det"><i class="fas fa-user-times"></i></span></div><div class="form-group"><label class="control-label">Name <i class="fas fa-info-circle" data-toggle="tooltip" for="person_name_'+rec_length+'" title="Name"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_name[]" id="person_name_'+rec_length+'" placeholder="Name"></div><div class="form-group"><label class="control-label">Title <i class="fas fa-info-circle" data-toggle="tooltip" for="person_title_'+rec_length+'" title="Title"></i></label><div class="input-field-wrap"><input type="text" class="form-control" name="person_title[]" id="person_title_'+rec_length+'" placeholder="Title"></div><div class="form-group"><label class="control-label">Image <i class="fas fa-info-circle" data-toggle="tooltip" for="person_image_'+rec_length+'" title="Image"></i></label><div class="input-field-wrap"><input type="file" class="form-control" name="person_image[]" id="person_image_'+rec_length+'" placeholder="Image"></div><div class="form-group"><label class="control-label">Short Description <i class="fas fa-info-circle" data-toggle="tooltip" for="person_short_desc_'+rec_length+'" title="Short Description"></i></label><div class="input-field-wrap"><textarea class="form-control myTextEditor" id="person_short_desc_'+rec_length+'" name="person_short_desc[]" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea></div></div>';

      $('#teamMemberListing').append(addMember);
      
    }
  });

    
});