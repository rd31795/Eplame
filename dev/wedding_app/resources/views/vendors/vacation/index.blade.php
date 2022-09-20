@extends('layouts.vendor')
@section('vendorContents')
<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Vacation</li>
            </ul>
   </div>
    <div class="side-btns-wrap">
         <a href="{{url(route($addLink))}}" class="add_btn">
          <i class="fa fa-plus"></i></a>
        </div>
     
</div>
@include('vendors.errors')

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
           <div class="card-header"><h3>{{$title}}   </h3></div>
           <div class="card-body">
                <div id="faq-accordion" class="faq-accordion">
                     @if($vacation->count() == 0)
                        <div class="col-md-12">
                          <div class="alert alert-warning" role="alert">No vacation.</div>
                        </div>
                     @endif


                  <table id="myTable" class="table">
                   <thead>
                    <tr>
                       <th>Start Date</th>
                       <th>End Date</th>
                       <th>Action</th>
                    </tr>
                    </thead>

                    @foreach($vacation as $vacations)
                         <tbody> <tr>
                            <td>
                              <strong>{{$vacations->vacation_from}}</strong>
                            </td>
                             <td>
                              <strong>{{$vacations->vacation_to}}</strong>
                            </td>
                            <td>
                               <a href="{{url(route('vendors.vacation.editVacation',[$vacations->id]))}}" class="icon-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit" ></i></a>
                               @php
                               $todayDate = date("Y-m-d");
                               if($vacations->vacation_to > $todayDate)
                               {@endphp
                                 <a  href="{{url(route('vendors.vacation.deleteVacation',[$vacations->id]))}}" class="icon-btn delete-confirm" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-window-close" ></i></a>
                              @php }
                                @endphp
                            </td>
                         </tr>
                         </tbody>
                    @endforeach
                    
                  </table>
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
</style>
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
<script type="text/javascript">
  
  $(document).ready(function(){
  $("#faq-accordion").on("hide.bs.collapse show.bs.collapse", e => {
    $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
  });
  });  
</script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

@endsection
