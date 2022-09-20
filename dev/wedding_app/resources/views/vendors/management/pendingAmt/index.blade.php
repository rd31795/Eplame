@extends('layouts.vendor')
@section('vendorContents')
<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">Pending Amount Details</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Pending Amount Details</li>
            </ul>
   </div>
     
</div>
@include('vendors.errors')

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
           <div class="card-header"><h3>Pending Amount Details  </h3></div>
           <div class="card-body">
                <div id="faq-accordion" class="faq-accordion">
                  <table class="table">
                    <tr>
                       <th>ORDERID</th>
                       <th>User</th>
                       <th>Total AMOUNT</th>
                       <th>Amount Recieved</th>
                       <th>Pending Amount</th>
                       <th>ACTION</th>
                    </tr>

                    @php $count = 0; @endphp
                    @if(!empty($orders[0]->id))
                      @foreach($orders as $order)

                      @php   
                        $arr = json_decode($order->order->balance_transaction);
                        $v = $order->vendor_id;
                        $cat_id = $order->category_id;
                        $parent = \App\Category::find($order->category_id)->parent;
                        $cate = \App\Category::find($order->category_id);
                        if($parent == 0){
                          $admin_escrow_percentage = $cate->escrow_percentage;
                        }else{
                          $parent_cat = Category::find($parent);
                          $admin_escrow_percentage =  $parent_cat->escrow_percentage;
                        }

                          if(!($admin_escrow_percentage > 0)){
                              $admin_escrow_percentage =  getAllValueWithMeta('admin_escrow_percentage', 'global-settings');
                          }
                        
                        $payable_amount = $arr->$v->payable_amount;
                          $date = \Carbon\Carbon::parse($order->created_at);
                          $now = \Carbon\Carbon::now();
                          $diff = $date->diffInDays($now);
                          $pend_amt = (($payable_amount * $admin_escrow_percentage)/100);
                          $rec_amt = $payable_amount - $pend_amt;
                      @endphp
                      @if($diff <= 30)
                        @php $count++; @endphp
                         <tr>
                            <td>
                              <strong>{{$order->OrderID}}</strong>
                            </td>
                            <td>
                              <strong>{{$order->user->name}}</strong>
                            </td>
                            <td>
                              <b> ${{custom_format($payable_amount, 2)}} </b>
                            </td>
                            <td>
                              <b> ${{custom_format($rec_amt ,2)}} </b>
                            </td>
                            <td>
                              <b> ${{custom_format($pend_amt,2)}} </b>
                            </td> 
                            
                            <td>
                              <a href="{{url(route('vendor.orderDetail',[$slug,$order->order_id]))}}" class="icon-btn"><i class="fa fa-eye"></i></a>
                            </td>
                         </tr>
                        @endif
                    @endforeach
                  @endif
                  
                    
                  </table>
                  @if($count == 0)
                    <div class="alert alert-info closer-step mb-3 mt-4" role="alert">
                      <i class="fa fa-info-circle"></i> No Pending Amount Details Found
                    </div>
                  @endif

                </div> 
           </div>
         </div>
      </div>
    </div>
</div>





 
   
@endsection


@section('scripts')

<script type="text/javascript">
  
  $(document).ready(function(){
  $("#faq-accordion").on("hide.bs.collapse show.bs.collapse", e => {
    $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
  });
  });    

</script>

@endsection
