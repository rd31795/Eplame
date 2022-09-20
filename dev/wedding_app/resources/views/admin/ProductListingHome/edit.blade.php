@extends('layouts.admin')
 
@section('content')
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10">{{ $title }}</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{$addLink}}">View</a></li>             
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
              <form  method="post" action="{{route('admin.home.productlist.update',['productlist_update_id'=>$productListing->id])}}" enctype="multipart/form-data" id="productlist_home_page">
                  @csrf
              <div class="row" style="width:100%;">
                 <div class="col-md-12">
                   {{textbox($errors,'Listing Heading','heading',$productListing->Heading)}}
                 </div>
                 <div class="col-md-12">
                  @php $categoriesarray=explode(',',$productListing->product_category); @endphp
                  <div class="product_category">
                      @foreach($productCategory as $k => $cate)
                            @php $array=[]; @endphp
                            @foreach($cate->subCategoryActives as $subcate)
                                  @php array_push($array,$subcate->id) @endphp
                            @endforeach
                          <div class="category_section">
                           <div class="form-group">
                             <label class="category_main h5"  ><strong>{{$cate->label}}</strong></label>
                             <input type="checkbox" id="category_{{$cate->id}}" class="category-checkbox" 
                             {{array_intersect($array,$categoriesarray) ? 'checked':''}}
                             />
                           </div>
                           <hr class="cs-hr">
                           <div class="product_subcategory">
                              @foreach($cate->subCategoryActives as $s => $subcate)
                              <div class="subcategory_section">
                              <div class="form-group">
                                 <label class="subcategory h5">
                                    <strong>--{{$subcate->label}}</strong>
                                 </label>
                                 <input type="checkbox" class="category_{{$cate->id}} subctegory-checkbox" id="subcategory_{{$subcate->id}}" data-id='category_{{$cate->id}}' value="{{$subcate->id}}" name="allcategory[]" 
                                 {{in_array($subcate->id,$categoriesarray) ? 'checked':''}}
                                 />
                               </div>
                                   <hr>
                                    <div class="product-sub-subcategory">
                                     @foreach($subcate->childCategoryActives as $ch => $childCate)
                                        <div class="form-group">
                                          <label class="sub-subcategory">----{{$childCate->label}}</label>
                                          <input type="checkbox" class="subcategory_{{$subcate->id}} sub-subctegory-checkbox" value="{{$childCate->id}}" data-main_category='category_{{$cate->id}}' data-id='subcategory_{{$subcate->id}}' name="allcategory[]" 
                                          {{in_array($childCate->id,$categoriesarray) ? 'checked':''}}
                                          />
                                        </div>
                                     @endforeach
                                    </div>
                                    </div>
                               @endforeach
                           </div>
                         </div>
                      @endforeach
                 </div>
                 </div>
                  <div class="card-footer">
                    <button type="submit" id="ProductList_home_FormBtn" class="btn btn-primary">Update</button>
                  </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
@endsection
@section('scripts')
<script src="{{url('/admin-assets/js/validations/productlisthome.js')}}"></script>
<script>
$( document ).ready(function() {
$(".category-checkbox").on("change",(e)=>{ $(`.${e.target.id}`).prop('checked',e.target.checked); $.each($(`.${e.target.id}`), function(key, value) {
       $(`.${value.id}`).prop('checked',value.checked);
});  }); 
$(".subctegory-checkbox").on("change",(e)=>{ 
  $(`.${e.target.id}`).prop('checked',e.target.checked);
}); 
$(".sub-subctegory-checkbox").on('change',(e)=>{
        let length=$(`.${e.target.dataset.id}.sub-subctegory-checkbox:checked`).length; 
        length==0 ? $(`#${e.target.dataset.id}`).prop('checked',false):$(`#${e.target.dataset.id}`).prop('checked',true);
        let maincatlength=$(`.${e.target.dataset.main_category}:checked`).length;
        let maincatId=$(`.${e.target.dataset.main_category}`).attr('data-id');
        maincatlength==0? $(`#${maincatId}`).prop('checked',false) : $(`#${maincatId}`).prop('checked',true);
});
$(".subctegory-checkbox").on('change',(e)=>{
        let length=$(`.${e.target.dataset.id}.subctegory-checkbox:checked`).length; 
        length==0 ? $(`#${e.target.dataset.id}`).prop('checked',false) :$(`#${e.target.dataset.id}`).prop('checked',true)
});
});
</script>
@endsection
