@extends('users.layouts.layout') 
@section('content')

<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Disputes</li>
            </ul>
   </div>
     
</div>


    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
           <div class="card-header"><h3>{{$title}}   </h3></div>
           <div class="card-body">
                <div id="faq-accordion" class="faq-accordion">
                     @if($dispute->count() == 0)
                        <div class="col-md-12">
                          <div class="alert alert-warning" role="alert">No Disputes.</div>
                        </div>
                     @endif


                  <table id="myTable" class="table">
                   <thead>
                    <tr>
                       <th>DISPUTE ID</th>
                       <th>ORDER ID</th>
                       <th>RAISED BY</th>
                       <th>STATUS</th>
                       <th>ACTION</th>
                    </tr>
                  </thead>

                    @foreach($dispute as $disputes)
                        <tbody>  <tr>
                            <td>
                              <strong>{{$disputes->id}}</strong>
                            </td>
                             <td>
                              <strong>{{$disputes->order_id}}</strong>
                            </td>
                            <td>
                              @php $userName = getUser($disputes->raised_by)  @endphp
                              <b>{{$userName->name}} </b>  
                            </td> 
                            @if($disputes->dispute_status == 1 || $disputes->dispute_status == 3 )
                            <td>Open</td>
                            @else
                            <td><a href="{{url(route('user.raiseAgain',[$disputes->id]))}}" title="raise dispute again" style="color:Red;">Closed</a></td>
                            @endif
                            <td>
                              <a href="{{url(route('user.disputeDetail',[$disputes->id]))}}" class="icon-btn" data-toggle="tooltip" title="View the dispute details"><i class="fa fa-eye"></i></a>
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
