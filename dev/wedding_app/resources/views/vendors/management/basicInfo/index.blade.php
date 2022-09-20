@extends('vendors.management.layout')
@section('vendorContents')

<div class="container-fluid">


 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">List</a></li>
            </ul>
        </div>
        <div class="side-btns-wrap">
        <a href="{{url(route($addLink, $slug))}}" class="add_btn"><i class="fa fa-pencil-alt"></i></a>
        </div>
  </div>
  
  @include('vendors.errors')

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
            <div class="card-header"><h3>{{$title}}</h3>
              <div class="deactivate-dlt">
                <form method="post" action="{{url(route('vendor_listing_actives',$slug))}}" >
                  @csrf
                  <button type="submit" class="act_button" data-toggle="tooltip" title="Activate or Deactivate"><?= $category->listing_active == 0 ? 'Activate' : 'Deactivate' ?></button>
                </form>
                <a href="{{url(route('vendor_listing_delete',$slug))}}" class="act_button delete-confirm" data-toggle="tooltip" data-placement="top" title="Delete">Delete</a>
              </div>
         </div>
          
        <div class="card-body">

        <div class="col-md-12">
        <div class="table-responsive"> 
		     	<table class="table">
		         <tr>
                  <th>Business Name</th>
                  <td>{{$business_name}}</td>
                </tr>

                <tr>
                  <th>Max Travel Distance (In Miles)</th>
                  <td>{{$travel_distaince}}</td>
                </tr>
                <tr>
                  <th>Company Name</th>
                  <td>{{$company}}</td>
                </tr>

                <tr>
                  <th>Price Start From</th>
                  <td>{{$min_price}}</td>
                </tr>

                <tr>
                  <th>Phone Number</th>
                  <td>{{$phone_number}}</td>
                </tr>

                <tr>
                  <th>Website</th>
                  <td><a href="{{$website}}">{{$website}}</a></td>
                </tr>

                 <tr>
                  <th>Address</th>
                  <td><?= $address?></td>
                </tr>

                 

         </table>
       </div>

		    </div>
    </div>
    
   </div>
  </div>
  </div>
</div>
 
 
@endsection

@section('scripts')
<style type="text/css">
  .swal-button--confirm {
    background-color: #3f4c67 !important;
  }
  .deactivate-dlt {
    display: flex;
    align-items: center;
    justify-content: center;
}
.deactivate-dlt form {
    margin-right: 10px;
}
.deactivate-dlt form .act_button {
    border: none;
}
</style>
<script type="text/javascript">
  CKEDITOR.replace('answer');
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>
@endsection
