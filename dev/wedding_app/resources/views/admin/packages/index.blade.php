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
                    <li class="breadcrumb-item"><a href="{{ url(route($addLink)) }}">Add</a></li>
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
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Package Price</th>
                                    <th>Package Image</th>
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
@php
   $check_event=$event??false;
@endphp 
$(function() { 
        var i=1;
    $('#example2').DataTable({
         
        processing: true,
        serverSide: true,
        "order": [[ 3, "desc" ]],
        ajax: "{{$check_event?url(route('ajax_getpackages_event')):url(route('ajax_getpackages'))}}",
        columns: [
             { data: 'title', name: 'title' },
             { data: 'summary', name: 'summary' ,type: 'html'},
             { data: 'price',  name: 'price'},
             { data:  'package_image', name:'package_image',   render: function( data, type, full, meta ) {
                        return "<img src=\"{{url('/wedding_app/public/uploads')}}/" + data + "\" height=\"100\" width=\"100\" />";
                    } },
             { data: 'status', name: 'status' },
             { data: 'updated_at', name: 'updated_at' },
             { data: 'action', name: 'action' },
        ]
       
    });

});
 

</script>
     
@endsection
