@extends('layouts.admin')

 
 
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Disputes</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item">Disputes</li>
                </ul>
            </div>
        </div>
    </div>
</div>

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ Hover-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Disputes</h5>
                                            <!-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> -->
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                              @include('admin.error_message')
                                                <table id="example2" class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        
                                                        @php $i=1; @endphp
                                                        <th>Dispute ID</th>
                                                        <th>Order ID</th>
                                                        <th>Raised By</th>
                                                        <th>Negotiated Amount</th>
                                                        <th>Amount Status</th>
                                                        <th>Status</th>
                                                        <th width="120">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>

@endsection

@section('scripts')
<script type="text/javascript">
 
 
$(function() { 
        var i=1;
    $('#example2').DataTable({
         
        processing: true,
        serverSide: true,
        ajax: '<?= url(route('admin.dispute.ajax')) ?>',
        columns: [
             { data: 'id', name: 'id' },
             { data: 'order_id', name: 'order_id' },            
             { data: 'raised_by',  name:'raised_by'},
             { data: 'vendor_amount',  name:'vendor_amount'},
             { data: 'amount',  name:'amount'},
             { data: 'dispute_status', name: 'dispute_status' },
             { data: 'action', name: 'action' },
        ]
       
    });
});
 
</script>
     
@endsection