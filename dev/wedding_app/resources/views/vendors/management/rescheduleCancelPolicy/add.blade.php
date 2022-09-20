@extends('vendors.management.layout')
@section('vendorContents')

<div class="container-fluid">

  <div class="page_head-card">
    <div class="page-info">
      <div class="page-header-title">
          <h3 class="m-b-10">{{$title}}</h3>
      </div>
      <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li class="breadcrumb-item"><a href="{{url(route($addLink ,$slug))}}">List</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Add</a></li>
      </ul>
    </div>
  </div>

@include('vendors.errors')


<div class="row">
  <div class="col-lg-12">
    <div class="card vendor-dash-card">
      <div class="card-header"><h3>{{$title}}</h3></div>
        <div class="card-body">
          <div class="col-md-12"> 
            <form method="post" id="add_people_form">
      			  @csrf
      			 <input type="hidden" id="counter" value="1">
                  @if(!empty($policies))
                {{textarea($errors, 'Add Policy*', 'policy' , $policies->policy)}}
                @else
                {{textarea($errors, 'Add Policy*', 'policy' )}}
                @endif
                <div class="table-responsive">
               <table id="mytable" class="table cstm-admin-table">
              <thead>
                <th>Days <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Enter days"></i></th> 
                <th>Percentage <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Enter percentage"></i></th>
                <th><input type="button" id="insert-more" value="Add Row"> <input type="button" id="dlt-row" value="Delete Row" onclick="deleteRows()" /></th>
                  </thead>
                  <tbody>
                 @if(!empty($policies)) 
                 <?php $v = json_decode($policies->days_percentage); //dd($v->days[0],$v->percentage[0]); ?>
                 @foreach($v->days as $key => $value)
                    <tr>
                      <td><input type="text" name="days[]" value="{{$value}}" class="form-control" ></td>                
                      <td><input type="text" name="percentage[]" value="{{$v->percentage[$key]}}" class="form-control" ></td>               
                    </tr>
                  @endforeach
              @endif
             <!--   <tr>
                      <td><input type="text" name="days[]" class="form-control" id="days" required></td>                
                      <td><input type="text" name="percentage[]" class="form-control" id="percentage" required></td>
               
                  </tr> -->
             </tbody></table>
          </div>
              <button type="submit" class="cstm-btn" >Save</button>
            </form>                 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 
</div>
@endsection

@section('scripts')
<script src="{{url('/js/validations/additionalInfoValidation.js')}}"></script>

<script type="text/javascript">
  var url = "<?php echo url('/'); ?>";
  var options = {
        filebrowserImageBrowseUrl: url+"/laravel-filemanager?type=Images",
        filebrowserImageUploadUrl: url+"/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}",
        filebrowserBrowseUrl: url+"/laravel-filemanager?type=Files",
        filebrowserUploadUrl: url+"/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}",
        
        filebrowserWindowWidth  : 800,
        filebrowserWindowHeight : 500,
        uiColor: '#eda208',
        removePlugins: 'save, newpage',
        allowedContent:true,
        fillEmptyBlocks:true,
        extraAllowedContent:'div, a, span, section, img, video'
      };
  CKEDITOR.replace('policy', options);
</script>
<script type="text/javascript">
  $("#insert-more").click(function () { 

    $("#mytable").each(function () {
        var counter = parseInt($('#counter').val());
           var tds = '<tr>';
        jQuery.each($('tr:last ', this), function () {
            tds += '<td><input type="text" name="days[]_' + counter + '" class="name_input form-control" id="days" ></td><td><input type="text" name="percentage[]_' + counter + '" class="email_input form-control" id="percentage" ></td>';
        });
        tds += '</tr>';

        if ($('tbody', this).length > 0) {
         
              $('tbody', this).append(tds);
               $('#counter').val( counter + 1 );
            
        } 
        else {
            $(this).append(tds);
        }
        
         
       
    });
});
$('form#add_people_form').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
    $('.name_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                digits: true,
            });
    });
    //Add validation rule for dynamically generated email fields
    $('.email_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                digits: true,
                
            });
    });
});
$("#add_people_form").validate();

</script>

<script type="text/javascript">
    function deleteRows(){
  var table = document.getElementById('mytable');
  var rowCount = table.rows.length;
  if(rowCount > '2'){
    var row = table.deleteRow(rowCount-1);
    rowCount--;
  }
  else{
    //alert('There should be atleast one row');
  }
}

</script>
<style type="text/css">
#mytable #insert-more {
    border: none;
    background-color: #eda208;
    color: #fff;
    cursor: pointer;
    padding: 5px 12px;
    border-radius: 5px;
    margin-right: 5px;
    font-size: 15px;
}
#mytable #dlt-row {
    border: none;
    cursor: pointer;
    padding: 5px 12px;
    border-radius: 5px;
    margin-right: 5px;
    font-size: 15px;
    background: #fff;
    color: #3f4c67;
    font-weight: 600;
}
#mytable td .error {
    top: 93%;
    left: 2%;
    border-color: #B00020;
    /*position: relative;*/
}
label.error {
    display: none !important;
}
</style>
@endsection
