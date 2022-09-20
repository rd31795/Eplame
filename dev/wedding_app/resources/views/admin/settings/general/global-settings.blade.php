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
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Edit</a></li>
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

<div class="col-md-12">

  <form role="form" method="post" id="globalSettingsForm" enctype="multipart/form-data">
      @csrf
    <div class="card">
      <div class="card-body">
    <div class="custom-swtch">
      <h5 class="card-title">Social Media Sharing</h5>
      <ul class="tg-list">
         <li class="tg-list-item">
            <span class="label">Facebook</span>
            <input class="tgl tgl-skewed" id="facebook" type="checkbox" name="facebook" value="1" {{ getAllValueWithMeta('facebook', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="facebook"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Pinterest</span>
            <input class="tgl tgl-skewed" id="pintrest" type="checkbox" name="pintrest" value="1" {{ getAllValueWithMeta('pintrest', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="pintrest"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Instagram</span>
            <input class="tgl tgl-skewed" id="instagram" type="checkbox" name="instagram" value="1" {{ getAllValueWithMeta('instagram', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="instagram"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Whatsapp</span>
            <input class="tgl tgl-skewed" id="whatsapp" type="checkbox" name="whatsapp" value="1" {{ getAllValueWithMeta('whatsapp', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="whatsapp"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Twitter</span>
            <input class="tgl tgl-skewed" id="twitter" type="checkbox" name="twitter" value="1" {{ getAllValueWithMeta('twitter', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="twitter"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Linkedin</span>
            <input class="tgl tgl-skewed" id="linkdin" type="checkbox" name="linkdin" value="1" {{ getAllValueWithMeta('linkdin', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="linkdin"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Snapchat</span>
            <input class="tgl tgl-skewed" id="snapchat" type="checkbox" name="snapchat" value="1" {{ getAllValueWithMeta('snapchat', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="snapchat"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Youtube</span>
            <input class="tgl tgl-skewed" id="youtube" type="checkbox" name="youtube" value="1" {{ getAllValueWithMeta('youtube', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="youtube"></label>
          </li>
          <li class="tg-list-item">
            <span class="label">Email</span>
            <input class="tgl tgl-skewed" id="email" type="checkbox" name="email" value="1" {{ getAllValueWithMeta('email', 'global-settings') === '1' ? 'checked' : '' }}/>
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="email"></label>
          </li>
        </ul>
      </div>
    </div>
  </div>
      <input type="hidden" name="type" value="global-settings">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Business Gallery Expiration Time (in Days)</h5>
           {{textbox($errors,'Exiration Time (in Days)*', 'gallery_expiration_time', getAllValueWithMeta('gallery_expiration_time', 'global-settings'))}}
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admin's Escrow Percentage</h5>
           {{textbox($errors,'Escrow Amount (in %)*', 'admin_escrow_percentage', getAllValueWithMeta('admin_escrow_percentage', 'global-settings'))}}
        </div>
      </div>

      <!-- google api key -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Google Api Key</h5>
           {{textbox($errors,'Google Api Key*', 'google_api_key', getAllValueWithMeta('google_api_key', 'global-settings'))}}
        </div>
      </div>

<!-- weather api key -->
       <div class="card">
        <div class="card-body">
          <h5 class="card-title">Weather Api Key</h5>
           {{textbox($errors,'Weather Api Key*', 'weather_api_key', getAllValueWithMeta('weather_api_key', 'global-settings'))}}
        </div>
      </div>

      <!-- Taxjar api key -->
       <div class="card">
        <div class="card-body">
          <h5 class="card-title">Taxjar Api Key</h5>
           {{textbox($errors,'Taxjar Api Key*', 'taxjar_api_key', getAllValueWithMeta('taxjar_api_key', 'global-settings'))}}
        </div>
      </div>


<!-- Fee -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Fee</h5>
           	
<div class="row">
  <div class="col-md-6">
   <div class="card">
        <div class="card-body">
          <h5 class="card-title">Commission Fee</h5>

	            <label>Commission Fee Type</label>
	            <div class="custom-control custom-radio mb-1">
			        <input type="radio" id="PriceType1" name="commission_fee_type" value="0" class="custom-control-input" {{ getAllValueWithMeta('commission_fee_type', 'global-settings') === '0' || getAllValueWithMeta('commission_fee_type', 'global-settings') !== '1' ? 'checked' : '' }} />
			        <label class="custom-control-label" for="PriceType1">Percent</label>
			    </div>

		       <div class="custom-control custom-radio">
		        <input type="radio" id="PriceType" name="commission_fee_type" value="1" class="custom-control-input" {{ getAllValueWithMeta('commission_fee_type', 'global-settings') === '1' ? 'checked' : '' }} />
		        <label class="custom-control-label" for="PriceType">Direct</label>
		      </div>

		       {{textbox($errors, 'Coomission Fee Amount*', 'commission_fee_amount', getAllValueWithMeta('commission_fee_amount', 'global-settings'))}}

        </div>
      </div>
    </div>

      <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Service Fee</h5>
          	<label>Service Fee Type</label>
	            <div class="custom-control custom-radio mb-1">
			        <input type="radio" id="PriceType1s" name="service_fee_type" value="0" class="custom-control-input" {{ getAllValueWithMeta('service_fee_type', 'global-settings') === '0' || getAllValueWithMeta('service_fee_type', 'global-settings') !== '1' ? 'checked' : '' }} />
			        <label class="custom-control-label" for="PriceType1s">Percent</label>
			    </div>

		       <div class="custom-control custom-radio">
		        <input type="radio" id="PriceTypes" name="service_fee_type" value="1" class="custom-control-input" {{ getAllValueWithMeta('service_fee_type', 'global-settings') === '1' ? 'checked' : '' }} />
		        <label class="custom-control-label" for="PriceTypes">Direct</label>
		      </div>

		       {{textbox($errors, 'Service Fee Amount*', 'service_fee_amount', getAllValueWithMeta('service_fee_amount', 'global-settings'))}}

        </div>
      </div>
      </div>

  
</div>
     
        </div>
      </div>
       <div class="card">
        <div class="card-body">
          <h5 class="card-title">Contact Settings</h5>
           {{textbox($errors,'Email*', 'contact_email', getAllValueWithMeta('contact_email', 'global-settings'))}}
           {{textbox($errors,'Alternative Email', 'alter_email', getAllValueWithMeta('alter_email', 'global-settings'))}}
           {{textbox($errors,'Address*', 'address', getAllValueWithMeta('address', 'global-settings'))}}
           {{textbox($errors,'Phone Number', 'phone_number', getAllValueWithMeta('phone_number', 'global-settings'))}}
           {{textbox($errors,'Mobile*', 'mobile', getAllValueWithMeta('mobile', 'global-settings'))}}
           {{textbox($errors,'Facebook ', 'facebook_url', getAllValueWithMeta('facebook_url', 'global-settings'))}}
           {{textbox($errors,'EmailId ', 'email_id', getAllValueWithMeta('email_id', 'global-settings'))}}
           {{textbox($errors,'Twitter ', 'twitter_url', getAllValueWithMeta('twitter_url', 'global-settings'))}}
           {{textbox($errors,'Instagram ', 'instagram_url', getAllValueWithMeta('instagram_url', 'global-settings'))}}
           {{textbox($errors,'Linkedin ', 'linkedin_url', getAllValueWithMeta('linkedin_url', 'global-settings'))}}
           {{textbox($errors,'Skype ', 'skype', getAllValueWithMeta('skype', 'global-settings'))}}
           {{textbox($errors,'WhatsApp ', 'whatsapp_num', getAllValueWithMeta('whatsapp_num', 'global-settings'))}}
         

        </div>
      </div>
      <div class="card-footer">
        <button type="submit" id="globalSettingsFormBtn" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/settings/globalSettingsValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection