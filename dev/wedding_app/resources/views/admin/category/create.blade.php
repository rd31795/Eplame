@extends('layouts.admin')
 
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{$title}}</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="{{ url($addLink) }}">View</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

       <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
       @include('admin.error_message')
 
            <div class="card-body">

 

                  <div class="col-md-12">

                    <form role="form" method="post" id="categoryForm" enctype="multipart/form-data">
                                
<div class="row">
                                         @csrf
          <div class="col-md-6"> 
             {{select3($errors,'Parent','parent','label','0',$category)}}
           </div>
        <div class="col-md-6" style="display: none">
         {{select3($errors,'SubParent','subparent','label','0',array())}}
       </div>
        <div class="col-md-6"> 
        {{textbox($errors,'Name*','label')}}
      </div>

            <div class="col-md-6">
                   <div class="form-group" >

                          <label>Featured | Not</label>

                          <select class="form-control" name="featured">
                            <option value="0">Featured</option>
                            <option value="1">Unfeatured</option>
                          </select>
                  </div>
                   
            </div>
           
 


<div class="col-md-6"> 
  <div class="form-group label-floating is-empty"><label class="control-label">Color*</label>
    <input type="color" value="#eda208" name="color" id="get" style="width: 46px; margin-left: -2px;" onchange="fetch()">
    <input type="text" readonly value="#eda208" class="form-control valid" name="color" id="color">
  </div>
</div>

<div class="col-md-4">

   <div class="form-group">
            <label class="label-file">Cover Photo/Video</label>

            <select name="cover_type" class="form-control">
              <option value="1">Photo</option>
              <option value="2">Video</option>
            </select>
            
           </div>
</div>

<div class="col-md-4">

   <div class="form-group">
            <label class="label-file">Capacity</label>

            <select name="capacity" class="form-control">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
            
           </div>
</div>

<div class="col-md-4">
    {{textbox($errors, 'Escrow Percentage', 'escrow_percentage')}}
</div>

<div class="col-md-6">   {{textbox($errors,'Meta Title*','meta_title')}}</div>
  <div class="col-md-6">  {{textbox($errors,'Meta Tags*','meta_tag')}}</div>
  <div class="col-md-12">  {{textarea($errors,'Meta description*','meta_description')}}</div>
 <div class="col-md-12">
                     <!-- {{choosefilemultiple($errors,'Category Icon','image')}} -->                    
         

                     <div class="form-group">
            <label class="label-file control-label">Image*</label>
            <input type="file" accept="image/*" required id="cat_image" onchange="ValidateSingleInput(this, 'image_src')" class="form-control" name="image">
           </div>
         <div class="form-group">
           <img src="" id="image_src" style="width: 100px; height: 100px; display: none"/>
         </div>

            </div>
     </div>                                 
      
      <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="categoryFormSbt" class="btn btn-primary">Submit</button>
            </div>
         </form>
        </div>
  </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
     
@endsection




@section('scripts')
<script src="{{url('/admin-assets/js/validations/categoryValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>

<script type="text/javascript">

  function fetch() {
  var get=document.getElementById("get").value;
  let color = document.getElementById("color");
  color.value = get;
  color.focus();
} 

  $('#parent').on('change',function(){

      var val = $( this ).val();

      getSubCategoryByCategoryId();

  });



  function getSubCategoryByCategoryId() {
 
   var val = $('select#parent option:selected').val();

    
    
    $.ajax({
     url: "<?= url('get-subcategory-by-parent') ?>" ,
     data:{
       'parent': val,
        'subparent':'0'
     },
     dataTYPE: 'json',
     success: function(result){

          var text ='<option value="0">select</option>';

           
          $.each(result, function( index, key ) {
                text +='<option value="'+key.id+'">'+key.label+'</option>';
           });


          $("#subparent").html(text);
     }});

  }
</script>
@endsection
