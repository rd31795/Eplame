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
                    <li class="breadcrumb-item"><a href="">listing</a></li>
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
                                             <div class="row">
                                                   <div class="col-md-6"><h5>{{$title}}</h5></div>
                                                   <div class="col-md-6 text-right">
                                                      <a href="?status=5" class="btn btn-info">All</a>
                                                      <a href="?status=0" class="btn btn-warning">Awaiting</a>
                                                      <a href="?status=1" class="btn btn-success">Approved</a>
                                                      <a href="?status=2" class="btn btn-danger">Rejected</a>
                                                   </div>
                  
                                             </div>
                                            
                                            <!-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> -->
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                              @include('admin.error_message')
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        
                                                        @php $i=1; @endphp
                                                         <th>Name</th>
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
        ajax: '<?= url(route('admin.shop.listing.ajax',['status' => $status])) ?>',
        columns: [
                    
             { data: 'name', name: 'name' },
             { data: 'status', name: 'status' },
             { data: 'action', name: 'action' },
        ]
       
    });
});
 
</script>
     
@endsection