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
                    <li class="breadcrumb-item "><a href="{{ route($addLink) }}">View</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0);">Create</a></li>
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

  <form role="form" method="post" id="CmsPageForm" enctype="multipart/form-data">
    @csrf
     
         {{textbox($errors, 'Title*', 'title')}}
         <div class="form-group">
          <label>Body*</label>
          <textarea class="form-control" id="body" name="body"></textarea>
        </div>

         {{textbox($errors,'Meta Title* <i class="fas fa-info-circle" data-toggle="tooltip" title="
The meta title refers to the title of a HTML document that is displayed both in Search Engine result snippets as well as the pages tab in browsers." ></i>','meta_title')}} 
         {{textbox($errors,'Meta Keywords* <i class="fas fa-info-circle" data-toggle="tooltip" title="
Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is." ></i>','meta_keywords')}}
         {{textarea($errors,'Meta Description* <i class="fas fa-info-circle" data-toggle="tooltip" title="

Meta descriptions will appear below the page title and URL in the search results." ></i>','meta_description')}}

      

      <div class="card-footer">
        <button type="submit" id="CmsPageFormBtn" class="btn btn-primary">Create</button>
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
<script src="{{url('/admin-assets/js/validations/cmsPageValidation.js')}}"></script>
<script type="text/javascript">
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
   CKEDITOR.replace('body', options);
</script>
@endsection
