$(document).ready(function(){
   // HomePage Form
	$('#checklistForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "checklist_title": {
          required: true,
          maxlength: 100,
      },
      "checklist_tagline": {
          required: true,
          maxlength: 100,
      },
      "checklist_video_title": {
          required: true,
          maxlength: 100,
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // HomePage Submitting Form 
    $('#checklistFormBtn').click(function()
    {
      if($('#checklistForm').valid())
      {
        $('#checklistFormBtn').prop('disabled', true);
        $('#checklistForm').submit();
      } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
        return false;
      }
    });
    
});
