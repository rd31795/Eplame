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

  <form role="form" method="post" id="venueForm" enctype="multipart/form-data">
                
                   @csrf
                    {{textbox($errors, 'Title*', 'title',$group->title)}}

                   <div class="profile-image">
                      <label> Access Permission</label>
                    @foreach($menus as $menu)
                   
                      @php $read_permission = 0;
                          $write_permission = 0;
                            $access_permission = accessPermissionSub($menu->id, $group->id);
                 
                      if(!empty($access_permission) && $access_permission->read_permission == 1){

                        $read_permission = 1;
                      }
                      if(!empty($access_permission) && $access_permission->write_permission == 1){
                        $write_permission = 1;
                      }
                      @endphp
                    <div class="main-form-grp">
                      <label class="lab">{{$menu->title}}</label>
                    <div class="form-group">
                       <label class="control control--checkbox">Read
                          <input type="checkbox" name="{{$menu->slug}}_read_permission" value="1" @if($read_permission == "1") checked @endif>
                          <span class="control__indicator"></span>
                      </label>

                      <label class="control control--checkbox">Write
                          <input type="checkbox" name="{{$menu->slug}}_write_permission"  value="1" @if($write_permission == "1") checked @endif>
                          <span class="control__indicator"></span>
                      </label>
                     </div>
                    </div>
                     <br> 
                          @endforeach
                    </div>
                
                

                <div class="card-footer">
                  <button type="submit" id="btnVanue" class="btn btn-primary">Submit</button>
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
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<!-- <script type="text/javascript">
  $(document).ready(function(){
   // Add Department Form
  $('#venueForm').validate({
    onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
    },
  
    highlight: function(element) {
      $('element').removeClass("error");
    },
  
    rules: {
      "title": { 
          required: true,          
      },
      "description": { 
          required: true,          
      },
      valueToBeTested: {
          required: true,
      }
    },
    });   
  
    // Add Department Submitting Form 
    $('#btnVanue').click(function()
    {
      if($('#venueForm').valid())
      {
        $('#btnVanue').prop('disabled', true);
        $('#venueForm').submit();
      } else {
        return false;
      }
    });
    
});

</script> -->
@endsection