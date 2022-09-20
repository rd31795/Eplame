<style>
  .tooltip {
    z-index: 1000000 !important;
}
.admission-form {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.admission-form .admission-reg {
    margin-right: 5px;
}
/*210913*/ 
.Registration-table thead th:first-child {
    min-width: 120px;
}

/*210913 end*/
</style>

<form id="secondEventCreate"  action="{{url(route('steps.second'))}}">
    @csrf
    <div class="formFileds">
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Vendor Services* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Vendor Services of Event"></i></label>
                <div class="messages"  id="hideDiv2" style="color:red"></div>
                <div class="row" id="all-services">
                </div>
            </div>
        </div>
    </div>
    <div class="btn-wrap text-right">
        <button class="cstm-btn solid-btn btn-back-step" data-action="step1" id="back" data-step="1" type="button">Back</button>
        <button class="cstm-btn solid-btn">Next</button>
    </div>
</form>

<script type="text/javascript">
jQuery(document).ready(function ($) {
  var row=1;
  $(document).on("click", "#add-row", function () {
  var new_row = '<tr id="row' + row + '"><td> <input type="text" class="form-control" name="reg_type[]' + row + '" id="reg_type" /></td><td> <input type="text" class="form-control" name="price[]'+ row + '" id="price" /></td><td><input type="text" class="form-control" name="capacity[]'+ row + '" id="capacity"/></td><td><input class="delete-row cstm-btn solid-btn" type="button" value="-" /></td></tr>';
    //alert(new_row);
  $('#test-body').append(new_row);
    row++;
    return false;
  });
  
  // Remove criterion
  $(document).on("click", ".delete-row", function () {
  //  alert("deleting row#"+row);
    if(row>1) {
      $(this).closest('tr').remove();
      row--;
    }
    return false;
  });

  var registrants = $('#registrants');
  registrants.hide();
  $('input[type="radio"]').change(function(){ var inputData = $(this).attr("value");if(inputData == 'b') { registrants.show();}else{registrants.hide();}});
  $(function() {
    setTimeout(function() { $("#hideDiv2").fadeOut(14000); }, 40000)
  });
});
</script>