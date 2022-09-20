@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10"></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('user_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
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
 
            <div class="card-body">

              @include('admin.error_message')

              <div class="row">
                <div class="col-sm-12 "> 
              @if(Auth::user()->role == 'vendor' && Auth::user()->vendor_status == 0)
                <p class="c-bold"> Your Profile is under verification.</p>
              @elseif(Auth::user()->role == 'vendor' && Auth::user()->vendor_status == 1)
                <p class="c-bold"> You are already a vendor </p>
              @else
              <form class="signUp-form" action="{{url(route('user_as_vendor'))}}" method="POST"  id="registerVendorForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="1">
                 <div class="row">
                     
                    <div class="col-lg-6">                          
                           <label>Address</label>
                         <div class="form-group">
                             <input type="text" name="location" formControlName="location" placeholder="Location" class="form-control"  />
                                <span class="input-icon"><i class="fas fa-map-marker"></i></span>
                              
                         </div>                              
                     </div>



                    <div class="col-lg-6">                          
                           <label>Provide Your Business Website</label>
                         <div class="form-group">
                             <input type="text" name="website_url" placeholder="Provide External Website" class="form-control"  />
                                <span class="input-icon"><i class="fas fa-link"></i></span>
                              
                         </div>                              
                     </div>




                    <div class="col-lg-6">                          
                           <label>Phone Number</label>
                         <div class="form-group">
                             <input type="text" name="phone_number" formControlName="location" placeholder="Phone Number" class="form-control"/><span class="input-icon"><i class="fas fa-phone"></i></span>
                              
                         </div>                              
                     </div>


                     <div class="col-lg-6"> 
                        <label>Provide EIN# or BS# 

                          <div class="demo-app hasToggle"> 
                              <i class="fas fa-info-circle"></i> 
                              <span class="toggle-info-dropdown">
                                <ul class="form-info-toggle">
                                   <li><p>EIN# is tax registeration ID in the US For Businesses</p></li>
                                   <li><p>BS# is tax registeration ID in the Canada For Businesses</p></li>
                              </span>
                          </div>
                        </label>                         
                         <div class="form-group">
                              <input type="text" name="ein_bs_number" formControlName="email" placeholder="Provide EIN# or BS#" class="form-control"/>
                              <span class="input-icon"><i class="fas fa-envelope"></i></span>
                          </div>                              
                     </div>
                     <div class="col-lg-6">                          
                             <label>Date of Birth</label>
                             <div class="form-group">
                                 <input type="date" id="age" name="age" formControlName="location" placeholder="Age" class="form-control"/>
                                 <!-- <span class="input-icon"><i class="fas fa-life-ring"></i></span> -->
                             </div>                              
                     </div>

                     <div class="col-lg-6">                          
                          <label>Provide your valid ID Proof.</label>
                         <div class="form-group">
                             <input type="file" name="id_proof" class="form-control"/>
                                <span class="input-icon"><i class="fas fa-id-card"></i></span>
                              
                         </div>                              
                     </div>

                    <!--  <div class="col-lg-6">                          
                          <label>2 x proof of business address </label>
                         <div class="form-group">
                             <input type="file" name="business_address_proof" formControlName="location" placeholder="Age" class="form-control"/>
                                <span class="input-icon"><i class="fas fa-id-card"></i></span>
                              
                         </div>                              
                     </div>

                     <div class="col-lg-6">                          
                          <label>Proof to show business is registered</label>
                         <div class="form-group">
                             <input type="file" name="business" formControlName="location" placeholder="Age" class="form-control"/>
                                <span class="input-icon"><i class="fas fa-id-card"></i></span>
                              
                         </div>                              
                     </div> -->

                    <div class="col-lg-6">  
                      <label>Choose Business Types</label>                        
                         <div class="form-group">
                          <?php $category = \App\Category::where('status',1)->where('parent',0)->orderBy('sorting','ASC')->get(); ?>                               
                              <select class="form-control select2" multiple="multiple" name="categories[]" id="categories" data-placeholder="Select Categories">
                                <option value="">Select Categories</option>
                                 @foreach($category as $cate)
                                  <option value="{{$cate->id}}">{{$cate->label}}</option>
                                 @endforeach
                              </select>
                                <span class="input-icon"><i class="fas fa-briefcase"></i></span>
                              
                         </div>                              
                     </div> 



              <!-- start  -->
                <div class="col-md-12">
                    <h3>Reference for Business</h3>
                     <div class="row">

                            

                         <div class="col-lg-12">  
                                <label>Reference Name</label>                        
                                 <div class="form-group">
                                      <input type="text" name="reference_business_name" formControlName="reference_business_name" placeholder="Reference Name" class="form-control"  />
                                     <span class="input-icon"><i class="fas fa-user"></i></span>
                                  </div>                              
                         </div>

                         <div class="col-lg-6">  
                                <label>Reference Email Address</label>                        
                                 <div class="form-group">
                                      <input type="text" name="reference_email" formControlName="Reference email" placeholder="Email Address" class="form-control"  />
                                     <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                </div>                              
                         </div>

                         <div class="col-lg-6">  
                                <label>Reference Contact Number</label>                        
                                 <div class="form-group">
                                      <input type="text" name="reference_contact_number" formControlName="Reference Contact Number" placeholder="Contact Number" class="form-control"  />
                                     <span class="input-icon"><i class="fas fa-phone"></i></span>
                                </div>                              
                         </div>

                     </div>
                </div>
                                            <!-- end  -->

                 <div class="col-md-12">
                      <div class="custom-control custom-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" name="agree" value="1" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">I agree to the Terms and Conditions. </label>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#info_modal" class="demo-app hasToggle"> 
                              <i class="fas fa-info-circle"></i>                                   
                          </a>
                      </div>
                 </div>                                



                 </div>

                 
                   
                      <div class="form-group btn-wrap text-center">
                          <button type="submit" class="cstm-btn solid-btn register-Submit">Register</button>
                      </div>
                      <div class="messages">
                      </div>
                      
                </form></div>

                @endif
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
     
<div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="info_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Term & Condition</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Allow us 48 hours to verify your business while you complete your profile and settle in. if we need any other information will shall be reaching out and if nothing else is needed you will be reviewing approving your business</p>
      </div>
    </div>
  </div>
</div>



@endsection
@section('scripts')
<script type="text/javascript" src="{{url('/frontend/js/become_a_vendor.js')}}"></script>
 
<script type="text/javascript">
  $('#categories').select2({ 
    closeOnSelect: false
   });
</script> 
@endsection
