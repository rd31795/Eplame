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

  <form role="form" method="post" id="ThankyouTemplateForm" enctype="multipart/form-data">
    @csrf
     
         {{textbox($errors, 'First Name*', 'first_name')}}
         {{textbox($errors, 'Last Name*', 'last_name')}}
         {{textbox($errors, 'Email*', 'email')}}
         {{password($errors, 'Password*', 'password')}}
         <div class="profile-image">
           <div class="main-form-grp">
              <label class="prolab">Groups*</label>
              <div class="form-group">
                <select  class="form-control"  name="group_name" id="group_name">
                  @foreach($groups as $group)
                  <option value="{{$group->id}}">{{$group->title}}</option>
                  @endforeach
                  <!--<option value="0">Others</option>-->
                </select>
              </div>
           </div>
          </div>
         <div class="profile-image">
          <div class="main-form-grp">
            <label class="prolab"> Profile Image*</label>
               <input type="file" name="image" accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" id="selImage" class="form-control" required>
               
              

                @if ($errors->has('image'))
                    <div class="error">{{ $errors->first('image') }}</div>
                @endif
              </div>

           </div>
            <img src="" id="image_src" style="width: 100px; height: 100px; display: none"/><br>
            <div class="profile-image permission"  style="display:none">
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
        <button type="submit" id="ThankyouTemplateFormBtn" class="btn btn-primary">Create</button>
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
  .prolab{
        width: 33% !important; 
    font-size: 14px !important; 
    font-weight: 400 !important; 
  }
</style>
<script>
  $('select[name="group_name"]').change(function() {

        const selectedDealLife = $(this).children("option:selected").val();
        if(selectedDealLife === '100') {
          $('.permission').css('display', 'flex');
        } else {
          $('.permission').css('display', 'none');
        }
    });
  </script>
<script src="{{url('/admin-assets/js/validations/thankyouTemplateValidation.js')}}"></script>
@endsection
