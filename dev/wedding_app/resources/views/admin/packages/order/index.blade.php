@extends('layouts.admin')
@section('content')

                    <!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{$title}}</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
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
                        <h5>{{$title}}</h5>
                        <!-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> -->
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                          @include('admin.error_message')
                            <table id="example2" class="table table-hover">
                                <thead>
                                <tr>
                                    
                                    @php $i=1; @endphp
                                    <th>orderId</th>
                                    <th>Purchase Date</th>
                                    <th>Expiry Date</th>
                                    <th>Price</th>
                                    <th>Package Name</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                  
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
 @php
   $check_event=$event??false;
@endphp 
 
$(function() { 
        var i=1;
    $('#example2').DataTable({
         
        processing: true,
        serverSide: true,
        "order": [[ 3, "desc" ]],
        ajax: "{{$check_event?url(route('ajax_getpackages_order_event')):url(route('ajax_getpackages_order'))}}",
        columns: [
             { data: 'orderId', name: 'orderId' },
             { data: 'start_date', name: 'start_date'},
             { data: 'expiry_date', name: 'expiry_date'},
             { data: 'price',  name: 'price'},
             { data: 'package_name',  name: 'package_name'},
             { data: 'email',  name: 'email'},
             { data: 'status', name: 'status' },
        ]
       
    });

});
 

</script>
     
@endsection