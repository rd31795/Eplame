@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2">
            <div class="page-header-title">
                <h5 class="m-b-10">{{$title}}</h5>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{url('/admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{ url($addLink) }}">Add</a></li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                @include('admin.error_message')
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Heading</th>
                                <th>Categories</th>
                                <th>View All Button</th>
                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productListing as $key=>$listing)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$listing->Heading}}</td>
                                <td style="white-space: inherit;">
                                    @php
                                    $product_categories=\App\Models\Products\ProductCategory::whereIn('id',explode(',',$listing->product_category))->get();
                                    foreach($product_categories as $key=>$value){
                                    echo '<span class="category_highlights">'.$value->label.'</span>';
                                    }
                                    @endphp
                                </td>
                                <td>{{$listing->view_all == App\ProductListHome::SHOW_VIEW_ALL ?'Show':'Hide'}}</td>
                                <td>{{$listing->status?'Active':'In-active'}}</td>
                                <td>
                                    <div class="btn-group"><button type="button" class="btn btn-primary">Action</button><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                        <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;"><a href="{{route('admin.home.productlist.edit',$listing->id)}}" class="dropdown-item">Edit</a>
                                            <div class="dropdown-divider"></div><a href="{{route('admin.home.productlist.status',$listing->id)}}" class="dropdown-item">{{!$listing->status?'Active':'In-Active'}}</a>
                                            <div class="dropdown-divider"></div><a href="{{route('admin.home.productlist.viewAllToggle',$listing->id)}}" class="dropdown-item">{{$listing->view_all== App\ProductListHome::HIDE_VIEW_ALL ? 'Show':'Hide'}}</a>
                                            <div class="dropdown-divider"></div><a href="{{route('admin.home.productlist.delete',$listing->id)}}" onclick="return confirm('Are you sure?')" class="dropdown-item ">Delete</a>
                                        </div>
                                    </div>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@endsection