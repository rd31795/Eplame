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
                  
                   {{textbox($errors, 'First Name*', 'first_name',$user->first_name)}}
                   {{textbox($errors, 'Last Name*', 'last_name',$user->last_name)}}
                    <div class="profile-image">
                     <div class="main-form-grp">
                        <label class="prolab">Groups*</label>
                        <div class="form-group">
                          <select  class="form-control"  name="group_name" id="group_name">
                            @if(!empty($group_id))
                            
                               @foreach($groups as $group)
                              <option value="{{$group->id}}" {{$group_id->group_id == $group->id  ? 'selected' : ''}} >{{$group->title}}</option>
                              @endforeach
                            @else
                            @php $group_id = 100;   @endphp
                            @foreach($groups as $group)
                              <option value="{{$group->id}}" {{$group_id == $group->id  ? 'selected' : ''}} >{{$group->title}}</option>
                              @endforeach
                          @endif
                          
                          </select>
                            
                        </div>
                     </div>
                    </div>

                  <div class="profile-image permission" style="display:none">
                    <label> Access Permission</label>
                    @foreach($menus as $menu)

                      @php $read_permission = 0;
                          $write_permission = 0;
                            $access_permission = accessPermission($menu->id, $user->id);
                     
                      if(!empty($access_permission) && $access_permission->read_permission == 1){
                        $read_permission = 1;
                      }
                      if(!empty($access_permission) && $access_permission->write_permission == 1){
                        $write_permission = 1;
                      }
                      @endphp
                    <div class="main-form-grp">
                      <label>{{$menu->title}}</label>
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
  .prolab{
        width: 33% !important; 
    font-size: 14px !important; 
    font-weight: 400 !important; 
  }
</style>
<script src="{{url('/admin-assets/js/validations/valueValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script>
   var select_id = document.getElementById("group_name");
  selectedDealLife = select_id.value;
   if(selectedDealLife === '100') {
          $('.permission').css('display', 'flex');
        } else {
          $('.permission').css('display', 'none');
        }

  $('select[name="group_name"]').change(function() {

       const selectedDealLife = $(this).children("option:selected").val();
        if(selectedDealLife === '100') {
          $('.permission').css('display', 'flex');
        } else {
          $('.permission').css('display', 'none');
        }
    });
</script>
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