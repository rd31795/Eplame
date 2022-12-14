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
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i><li class="breadcrumb-item"><a href="javascript:void(0)">Listing</a></li></a>
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
                                    <th>Order ID</th>
                                    <th>Business Name</th>
                                    <th>User Name</th>
                                    <th>Title</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
        "order": [[ 6, "desc" ]],
        ajax: '<?= url(route('ajax_getreviews')) ?>',
        columns: [
             { data: 'order_id', name: 'order_id' },
             { data: 'vendor_category_id', name: 'vendor_category_id' },
             { data: 'user_id', name: 'user_id' },
             { data: 'title', name: 'title' },
             { data: 'rating', name: 'rating' },
             { data: 'admin_approval', name: 'admin_approval' },
             { data: 'updated_at', name: 'updated_at' },
             { data: 'action', name: 'action' },
        ]
       
    });

});
 

</script>
     
@endsection
