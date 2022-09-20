@extends('layouts.admin')
 
@section('content')

<div class="container-fluid">


 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{ route($addLink) }}">View</a></li>
            </ul>
        </div>
  </div>

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
            <div class="card-header">
              <h3>{{$title}} </h3>
            </div>
                 <div class="card-body">  
                     <form method="post" id="dealForm" enctype="multipart/form-data">
                          @csrf
                         <div class="row"> 
                           <div class="col-lg-6">
                            {{textbox($errors,'Title*','title',$coupon->title)}}
                           </div>

                           <div class="col-lg-6"> 
                            {{textbox($errors, 'Deal Code*', 'deal_code',$coupon->deal_code)}}
                           </div>

                            <div class="col-lg-6">
                              {{selectsimple($errors, "Deal's Life", 'deal_life',[0 => 'Permanent',1 => 'According to Expiry Date'],$coupon->deal_life)}}
                          </div>

                            <div class="col-lg-6" style="display: {{ $coupon->deal_life >= '1'? 'block' : 'none' }}">
                            {{datebox($errors, 'Start Date', 'start_date', date('Y-m-d',strtotime($coupon->start_date)))}}
                           </div>

                           <div class="col-lg-6" style="display:  {{ $coupon->deal_life >= '1'   ? 'block' : 'none' }}">
                          {{datebox($errors,'Expiry Date','expiry_date', date('Y-m-d',strtotime($coupon->expiry_date)))}}
                          </div>

                          <div class="col-lg-6">
                              {{selectsimple($errors, "Deal's Off Type", 'deal_off_type',[0 => 'Percent',1 => 'Direct'], $coupon->deal_off_type)}}
                          </div>
                          <div class="col-lg-6">
                            {{textbox($errors, 'Percent/Amount*', 'amount',$coupon->amount)}}
                           </div>

                           <div class="col-lg-12" style="display: none;" id="min_rs">
                            {{textbox($errors, 'Apply on Min Order Amount*', 'min_amount',$coupon->min_price)}}
                           </div>

                           
                           <div class="col-lg-6"> 
                            {{textarea($errors,'Description*','description',$coupon->description)}}
                           </div>
                        
                         
      <!--        <div class="form-group">
                <div class="col-lg-12">
                 
                      <div class="category-radio category-title">
                      <input type="radio" name="type" value="1" id="type-parmanently" >
                           <label for="type-parmanently">Permanent promotion</label>
 
                    </div>
                    
                    

                  </div>

                   <div class="col-lg-12">
                 
                      <div class="category-radio category-title">
                      <input type="radio" name="type" value="0" id="type-parmanently" >
                           <label for="type-parmanently">Permanent promotion</label>
 
                    </div>
                    
                    

                  </div>


</div> -->







                        <div class="card-footer">
                      <button type="submit" id="btnMenu" class="btn btn-primary">Submit</button>
                    </div>
                   </form>
                </div>
           </div>
         </div>
     </div>
 </div>
 
</div>
@endsection

@section('scripts')
<script src="{{url('/js/validations/dealValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script type="text/javascript">


  $('select[name="deal_life"]').change(function() {
        const selectedDealLife = $(this).children("option:selected").val();
        if(selectedDealLife >= '1') {
          $('#start_date').parents('.col-lg-6').css('display', 'block');
          $('#expiry_date').parents('.col-lg-6').css('display', 'block');
        } else {
          $('#start_date').parents('.col-lg-6').css('display', 'none');
          $('#expiry_date').parents('.col-lg-6').css('display', 'none');
        }
    });

  $("#start_date").change(function() {
    $(this).parent('.form-group').find('label').eq(1).css('display', 'none');
  });

  $("#expiry_date").change(function() {
    $(this).parent('.form-group').find('label').eq(1).css('display', 'none');
  });

  $('select[name="type_of_deal"]').change(function() {
      const selectedDealLife = $(this).children("option:selected").val();
        if(selectedDealLife === '0') {
          $('#deal_code').parents('.col-lg-6').css('display', 'block');
          $('#packages').parents('.col-lg-6').css('display', 'none');
        } else if(selectedDealLife === '1') {
          $('#deal_code').parents('.col-lg-6').css('display', 'none');
          $('#packages').parents('.col-lg-6').css('display', 'block');
        } else {
          $('#deal_code').parents('.col-lg-6').css('display', 'none');
          $('#packages').parents('.col-lg-6').css('display', 'none');
        }
  });

</script>
@endsection