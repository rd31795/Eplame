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
                  @csrf           
            <div class="row">
        
            <div class="col-md-6">
                   <div class="form-group" >

                          <label>Page Type</label>

                          <select class="form-control" name="page_type">
                            <option  value="0" {{ ($cmsmenu->page_type) == '0' ? 'selected' : '' }}>CMS Pages</option>
                            <option value="1" {{ ($cmsmenu->page_type) == '1' ? 'selected' : '' }}>Custom page</option>
                          </select>
                  </div>
                   
            </div>
            <div class="col-md-6 cmspage" style="display: {{ $cmsmenu->page_type == '0'? 'block' : 'none' }}">
                   <div class="form-group" >

                      <label>CMS Pages</label>
                      <select  class="form-control"  name="cmspage" id="cmspage">
                    <option value="">Select CMS page</option>
                    @foreach($cmspages as $cmspage)
                  <option value="{{$cmspage->id}}" {{$cmspage->id == $cmsmenu->cms_id  ? 'selected' : ''}}>{{$cmspage->title}}</option>
                  @endforeach
                </select>


                  </div>
                   
            </div>
             <div class="col-md-6 Custom" style="display: {{ $cmsmenu->page_type == '1'? 'block' : 'none' }}">
                   <div class="form-group" >
                      <label>Custom Name</label>
                      <input type="text" name="custom_name" id="custom_name" class="form-control" value="{{$cmsmenu->custom_name}}">
                  </div>
                   
            </div>
             <div class="col-md-6 Custom" style="display: {{ $cmsmenu->page_type == '1'? 'block' : 'none' }}">
                   <div class="form-group" >
                      <label>Custom URL</label>
                      <input type="text" name="custom_url" id="custom_url" class="form-control" value="{{$cmsmenu->custom_url}}">
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

<script>
  $('select[name="page_type"]').change(function() {

        const selectedDealLife = $(this).children("option:selected").val();
        if(selectedDealLife === '1') {
          $('.cmspage').css('display', 'none');
          $('.Custom').css('display', 'block');
        } else {
          $('.cmspage').css('display', 'block');
          $('.Custom').css('display', 'none');
        }
    });
  </script>
@endsection
