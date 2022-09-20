@extends('layouts.vendor')
@section('vendorContents')

             
<div class="container-fluid">



<!-- header -->

<div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">Shop :: Products </h3>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="http://49.249.236.30:6633/vendors"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Add</a></li>
            </ul>
        </div>
        <div class="side-btns-wrap">
        <a href="{{url(route('vendor.shop.products.index'))}}" class="add_btn"><i class="fa fa-eye"></i></a>
        </div>
  </div>


<!-- header -->
<input type="hidden" id="cateCheck" value="{{$product->childcategory == null || $product->childcategory->count() == 0 ? 0 : 1 }}">
  


    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
                  <div class="card-header">Assign Categories</div>
		           <div class="card-body">
                      <form method="post" enctype="multipart/form-data">
		           	       <div class="row">
                          <div class="col-md-12">
                                      <div class="form-group text-right">
                                            <button class="cstm-btn btn-submit next">Save</button>
                                      </div>
                           </div>
                           <div class="col-md-6">
                                 <label>Product Category</label>
                                 <a href="javascript:void(0)" class="categoryAssign form-control">
                                 	{{$product->category != null && $product->category->count() > 0 ? $product->category->label : ''}} |
                                 	{{$product->subcategory != null && $product->subcategory->count() > 0 ? $product->subcategory->label : ''}} |
                                 	{{$product->childcategory != null && $product->childcategory->count() > 0 ? $product->childcategory->label : ''}}
                                 </a>
                           </div>

                           <div class="col-md-6">
                                 {{textbox($errors,'Product Name','name',$product->name)}}
                           </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control" name="product_type_id">
                                    <option value="">select</option>
                                    @foreach($productTypes as $productType)
                                      @if(!is_null($product->product_type_id) && $product->product_type_id == $productType->id)
                                        <option value="{{$productType->id}}" selected>{{$productType->label}}</option>
                                      @else
                                        <option value="{{$productType->id}}">{{$productType->label}}</option>
                                      @endif
                                    @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Is Product Negotiable</label><br>
                                <input type="radio" name="is_negotiable" value="1" @if($product->is_negotiable == 1){{'checked'}}@endif> YES
                                <input type="radio" name="is_negotiable" value="0" @if($product->is_negotiable == 0){{'checked'}}@endif> NO
                              </div>
                              <div class="form-group">
                              
                                <label>Is Product is available for Local Pickup</label><br>
                                 <input type="radio" name="is_local_pickup" value="1" <?php if($product->local_pickup==1){ echo 'checked'; } ?> id="is_local_pickup_0"> Yes
                                 <input type="radio" name="is_local_pickup" value="0"  <?php if($product->local_pickup==0){ echo 'checked'; } ?>  id="is_local_pickup_1"> No
                              </div>
                              <div class="form-group">
                                <label>Is Product is available for Shipping</label><br>
                                 <input type="radio" name="is_shipping" id="shipping_0" value="1"  @if($product->shipping_available == 1) {{'checked'}} @endif > Yes
                                 <input type="radio" name="is_shipping" id="shipping_1" value="0"  @if($product->shipping_available == 0) {{'checked'}} @endif > No
                              </div>

                              <div class="form-group" id="is_shipping_charges" style="@if($product->shipping_available == 0) {{'display: none'}} @endif">
                                <label>Is Product is available for free shipping</label><br>
                                 <input type="radio" name="is_shipping_charges" value="0" id="no_charges"  @if($product->shipping == 0){{'checked'}}@endif > Yes
                                 <input type="radio" name="is_shipping_charges" value="1"   @if($product->shipping == 1){{'checked'}}@endif > No
                              </div>
                              
                            </div>

                            <div class="col-md-12">
            
                              <div class="form-group ">
                                <div class="profile-image">
                                  <label class="label-file">Product Main Thumbnail*</label>
                                           <input type="file" name="thumbnail" accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" id="image" class="form-control">
                                           
                                                <img id="image_src" class="img-radius" style="display:{{$product->thumbnail != null ? 'block' : 'none'}}; width: 100px; height: 100px; margin-top: 6px;" src="{{$product->thumbnail != "" ? url($product->thumbnail) : ''}}"> 
                                              @if($product->thumbnail != null)
                                                <input type="hidden" name="thumbnail" value="{{$product->thumbnail}}">
                                              @endif
                                            @if ($errors->has('thumbnail'))
                                                <div class="error">{{ $errors->first('thumbnail') }}</div>
                                            @endif
                                     </div>
                                 </div>
                             </div>
                           <div class="col-md-12">
                                 {{textarea($errors,'Short Description','short_description',$product->short_description)}}
                           </div>
                           <div class="col-md-12">
                                 {{textarea($errors,'Description','description',$product->description)}}
                           </div>

                     </div>
                   </form>



                    <div class="col-md-12">
                       <!-- {{choosefilemultiple($errors,'Product Images','images[]')}} -->
                       <div class="form-group">
                               <label>Product Images</label>
                              <input type="file" name="images[]" id="product_images" accept="image/*">
                       </div>
                          <script type="text/javascript">
                                     $('#product_images').fileinput({
                                             'theme': 'explorer-fas',
                                              // headers: {
                                              //      // 'X-CSRF-TOKEN': $('input[name=_token]').val(),
                                              //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              // },
                                             'uploadUrl': "{{url(route('vendor.shop.products.ajax.imageUploading',$product->id))}}",
                                              overwriteInitial: false,
                                              initialPreviewAsData: true,
                                              allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
                                              minImageWidth: 500,
                                              minImageHeight: 400,
                                              initialPreview: [
                                                 <?php foreach($product->ProductImages as $p): ?>
                                                     '{{url($p->image)}}',
                                                 <?php endforeach; ?>
                                              ],
                                              initialPreviewConfig: [

                                                  <?php foreach($product->ProductImages as $p): ?>
                                                      {
                                                          'caption' : 'product_image',
                                                          'url' : '<?= url(route('vendor.shop.products.ajax.DeleteImageUploading',[$product->id,$p->id])) ?>',
                                                          'key' : 'image1'
                                                        },
                                                  <?php endforeach; ?>
                                                   
                                              ],
                                              uploadExtraData: { '_token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                });
                           </script>    
                    </div>








                    <div class="row">
                           <div class="col-md-12">
                              @if($product->category != null && $product->category->count() > 0)
                                @include('vendors.E-shop.products.variations')
                              @endif

                           </div>

                    

                         
                        </div>
                   </div>
         </div>
     </div>
   </div>
 </div>

 




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Category</h4>
      </div>
      <div class="modal-body">
             <form id="productCategories" action="{{url(route('vendor.shop.products.saveCategory',$product->id))}}">
             	<input type="hidden" id="categoryAjaxRoute" value="{{url(route('vendor.shop.products.ajax.categories'))}}">
             	<div class="col-md-12">
                      <div class="form-group">
                      	  <label>Category</label>
                      	  <select class="form-control" name="category_id">
                      	  	  <option value="">select</option>
                      	  	  @foreach($category as $cate)
	                      	  	  <option value="{{$cate->id}}" {{$cate->id == $product->category_id ? 'selected' : ''}}>{{$cate->label}}</option>
                      	  	  @endforeach
                      	  </select>
                      </div>

                       <div class="form-group">
                      	  <label>Sub Category</label>
                      	  <select class="form-control" name="subcategory_id" id="subCategory">
                      	  	  <option value="">select</option>
                      	  	  @if($product->category != null && $product->category->count() > 0 )
	                      	  	  @foreach($ShopCategory->parentCategory($shop->id,$product->category->id) as $cate)
		                      	  	  <option value="{{$cate->id}}" {{$cate->id == $product->subcategory_id ? 'selected' : ''}}>{{$cate->label}}</option>
	                      	  	  @endforeach
                      	  	  @endif
                      	  </select>
                      </div>

                      <div class="form-group">
                      	  <label>Child Category</label>
                      	  <select class="form-control" name="childcategory_id" id="childCategory">
                      	  	  <option value="">select</option>
                      	  	  @if($product->subcategory != null && $product->subcategory->count() > 0 )
	                      	  	  @foreach($product->subcategory->childCategory as $cate)
		                      	  	  <option value="{{$cate->id}}" {{$cate->id == $product->childcategory_id ? 'selected' : ''}}>{{$cate->label}}</option>
	                      	  	  @endforeach
                      	  	  @endif
                      	  </select>
                      </div>

                        <div class="form-group">
                             <button class="cstm-btn btn-submit next">Save</button>
                       </div>
                </div>
             </form>
      </div>
       
    </div>
  </div>
</div>


@endsection
@section('scripts')

         
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script type="text/javascript" src="{{url('/js/shop/vendors/products/category.js')}}"></script>
<script type="text/javascript" src="{{url('/js/shop/vendors/products/variation/basic.js')}}"></script>
<script type="text/javascript" src="{{url('/js/shop/vendors/products/variation/attributes.js')}}"></script>
<script type="text/javascript" src="{{url('/js/shop/vendors/products/variation/inventory.js')}}"></script>
<script type="text/javascript">

	@if($product->category == null || $product->category->count() == 0)
	                  var $modal = $("body").find('#myModal');
                          $modal.modal({backdrop: 'static', keyboard: false});
	@endif

   var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserWindowWidth  : 800,
        filebrowserWindowHeight : 500,
        uiColor: '#eda208',
        removePlugins: 'save, newpage',
        allowedContent:true,
        fillEmptyBlocks:true,
        extraAllowedContent:'div, a, span, section, img'
      };
  CKEDITOR.replace('description', options);


function yesOrNoToggle(selector,action,based_on_value){ $(`${selector}`).on("change",(e)=>{ 

  if(e.target.value==based_on_value){
    document.querySelector(`${action}${e.target.value}`).checked=true;  
}else{
    document.querySelector(`${action}${e.target.value}`).checked=true;  
}  
});  

}

$("input[name='is_shipping']").on("change",(e)=>{
  if(e.target.value==1){
    $("#is_shipping_charges").show();
  }else{
    $("#is_shipping_charges").hide();
    document.querySelector("#no_charges").checked=true;
  }
});
$("input[name='is_local_pickup']").on('change',(e)=>{
   if(e.target.value==1){
      $("#is_shipping_charges").hide();
      document.querySelector("#no_charges").checked=true;
   }else{
      $("#is_shipping_charges").show();
   }
});
yesOrNoToggle("input[name='is_local_pickup']","#shipping_",0);
yesOrNoToggle("input[name='is_shipping']","#is_local_pickup_",0);
</script>





@endsection