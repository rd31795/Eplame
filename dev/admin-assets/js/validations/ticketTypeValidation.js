$(document).ready(function(){
   //  Form
	$('#TicketTypeForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "type": { 
          required: true,
          maxlength: 50,
      }
    },
    });   
  
    //  Submitting Form 
    $('#TicketTypeFormBtn').click(function()
    {
      if($('#TicketTypeForm').valid())
      {
        $('#TicketTypeFormBtn').prop('disabled', true);
        $('#TicketTypeForm').submit();
      } else {
        return false;
      }
    });

    $("#TicketTypeFormBtn").on("click",function(){
    if (($("input[name*='ticket_templates']:checked").length)<=0) {
        alert("You must check at least 1 template");
    }
    return true;
});
    
});
