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

  <form role="form" method="post" id="menuForm" enctype="multipart/form-data">
    @csrf
     
         {{textbox($errors, 'Title*', 'title')}}
        <div class="profile-image">
            <label> Access Permission</label>
            @foreach($menus as $menu)
            <div class="main-form-grp">
            <label class="lab">{{$menu->title}}</label>

             <div class="form-group">
               <label class="control control--checkbox">Read
                <input type="checkbox" name="{{$menu->slug}}_read_permission" value="1">
                <span class="control__indicator"></span>
            </label>
             <!-- <input type="checkbox" name="{{$menu->slug}}_read_permission"  value="1"> Read  -->
            <label class="control control--checkbox">Write
                <input type="checkbox" name="{{$menu->slug}}_write_permission" value="1">
                <span class="control__indicator"></span>
            </label>
             <!-- <input type="checkbox" name="{{$menu->slug}}_write_permission"  value="1"> Write -->
             </div>
           </div>
              <br>    
                  @endforeach
            </div>
          

      

      <div class="card-footer">
        <button type="submit" id="btnMenu" class="btn btn-primary">Create</button>
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
<style>
  .lab{
        font-size: 15px !important;
        font-weight: 600 !important;
  }
</style>
<script src="{{url('/admin-assets/js/validations/valueValidation.js')}}"></script>
@endsection
