// Get Current color and append the value in next input
// function loadColorJQ() {
//     $('.ColorGet').on('change', function() { 
//       var val = $( this ).val();
//       $( this ).next().val(val);
//     });
//   }

// loadColorJQ();

// Add Remove multiple color for event

$(document).ready(function() {
    const maxField = 4; //Input fields increment limitation
    const wrapper = $('.field_wrapper'); //Input field wrapper
    const addBtn = `<li> <button class="icon-btn add_button action_btn" type="button" style=""><i class="fas fa-plus"></i></button></li>`;
    // const removeBtn = `<li> <button class="icon-btn btn-danger add-more action_btn" type="button"
    //                      style="">
    //          <i class="fas fa-trash-alt"></i>
    //     </button></li>`;


    const wrapper2 = $('.field_wrapper2');
    let x = parseInt($('#countColours').val()); //Initial field counter is 1


    //Once add button is clicked

    function addBtnJQ(addButton) {
        $(addButton).click(function() {
            //console.log('x add ', x);
            //Check maximum number of input fields
            if (x < maxField) {

                $(wrapper).append(`
                        <div class="element col-lg-3 col-md-6">
                             <div class="pick-color-field-wrap">
                                  <div class="form-group">
                                    <input type="color" onchange="GetColour(this)" id="event_color_name` + x + `" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours[]">
                                    <input type="text" onchange="GetColourName(this)" id="event_color_name` + x + `" placeholder="Colour Name" class="form-control ColourSelect" name="colourNames[]" > 
                                    <ul class="input-group-btn color-btn acrdn-action-btns remove_button" id="` + x + `">
                                       <li> <button class="icon-btn btn-danger add-more action_btn" id="` + x + `" type="button"
                            style="">
                            <i class="fas fa-trash-alt"></i>
                       </button></li>
                                    </ul>
                                  </div>
                              </div>
                        </div>`); // Add field html

                // loadColorJQ(); 
                $(wrapper2).append('<span class="theme-color-box theme-color-wrap  element2" style="background:#000" id="event_color_name' + x + '"></span>');

                x++; //Increment field counter
            }
            if (x === 4) {
                $($('.color-btn')[0]).addClass('remove_button');
                $($('.color-btn')[0]).html('<li> <button class="icon-btn btn-danger add-more action_btn" type="button" style=""><i class="fas fa-trash-alt"></i></button></li>');
            }
        });
    }

    addBtnJQ('.add_button');

    //Once remove button is clicked
    //var y = 3;
    $(wrapper).on('click', '.remove_button', function(e) {
        var currentElemID = $(this).attr('id');
        //alert(currentElemID);
        console.log('x del ', x);
        $(this).parents('.element').remove(); //Remove field html
        //$('.element2').remove();
        $('#event_color_name' + currentElemID + '').remove();
        x--; //Decrement field counter
        if (x < maxField) {
            $($('.color-btn')[0]).removeClass('remove_button');
            $($('.color-btn')[0]).html(addBtn);
            addBtnJQ('.add_button');
        }
    });
});


function GetColour($this) {
    var id = $this.id;
    var val = $this.value;
    $('#' + id + '').css('background-color', val);
}

function GetColourName($this) {
    var id = $this.id;
    var val = $this.value;
    var data_id = $("#" +id).attr("data-id");

    $('#' + id + '').val(val);

    if(typeof data_id != undefined && data_id !=  null){
        $('#' + data_id + '').val(val);
    }
    
}