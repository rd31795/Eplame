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
             <div class="card-header">
             <h5>Commission Slabs</h5>                                            
        </div>
       
 
            <div class="card-body">

@include('admin.error_message')
<div class="row">






 






  
<div class="col-md-12">
        
           
           <div class="row">
             <div class="col-md-6 ">
                <form method="post">
                   @csrf
                   <div class="row"> 
                    <input type="hidden" name="type" value="slab">
                      <div class="col-lg-12">
                      
                       {{textbox($errors,'Vendor Name','vendor_id',$vendors->name)}}
                      </div>
                       <div class="col-lg-12">
                         {{textbox($errors,'Commission Fee Start Slab','slab_from')}}
                      </div>
                       <div class="col-lg-12">
                         {{textbox($errors,'Commission Fee End Slab','slab_to')}}
                        </div>
                       <div class="col-lg-12">
                            {{selectsimple($errors, "Commission Type", 'commission_type',[0 => 'Percent',1 => 'Fixed'])}}
                        </div>
                        <div class="col-lg-12" >
                         {{textbox($errors,'Commission Fee (In Percent %)','amount')}}
                        </div>
                          <div class="col-lg-12" style="display: none;">
                         {{textbox($errors,' Fixed Commission Fee','min_amount')}}
                        </div>
                     

                    <button class="btn btn-primary">Save</button>
                  </div>
                </form>
             </div>
             
            <div class="col-md-6">
               <div class="table-responsive">
               <table class="table cstm-admin-table"">
              <tr>
                <th>Slabs</th> 
                <th>Commission fee</th>
                <th>Action</th>
              </tr>

              @foreach($slab as $s)

                  <tr>
                    <td>From <b>${{$s->slab_from}}</b> To <b>${{$s->slab_to}}</b></td>
                    
                   @if(!empty($s->amount))
                    
                       <td>{{$s->amount}}%</td>
                     @else
                      <td>{{$s->min_amount}}</td>
                   
                   @endif
                    <td><a href="{{url(route('admin.commissionDelete1',$s->id))}}">Delete</a></td>
                  </tr>

              @endforeach
            </table>
          </div>
         </div>
       
</div>
</div>


</div>
</div>
      </div>
    </div>
  </div>
</div>
</section> 
     
@endsection

@section('scripts')
<script src="{{url('/admin-assets/js/validations/settings/globalSettingsValidation.js')}}"></script>
<script src="{{url('/js/validations/dealValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script type="text/javascript">
 $('select[name="commission_type"]').change(function() {
        const commission = $(this).children("option:selected").val();
        if(commission === '1') {
           $('#min_amount').parents('.col-lg-12').css('display', 'block');
          $('#amount').parents('.col-lg-12').css('display', 'none');
        } else {
          $('#min_amount').parents('.col-lg-12').css('display', 'none');
           $('#amount').parents('.col-lg-12').css('display', 'block');
        }
    });
</script>
@endsection