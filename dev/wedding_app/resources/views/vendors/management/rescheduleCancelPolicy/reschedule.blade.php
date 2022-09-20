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
  </div>
@include('vendors.errors')

 
    <div class="row">
      <div class="col-lg-12">
        <div class="card vendor-dash-card">
          <div class="card-header">
            <h3>{{$title}} </h3>
          </div>
          <div class="card-body additional-info-index">
            <div class="col-md-12"> 
              @if($rescheduleRequest == '')
                <div class="col-md-12">
                  <div class="alert alert-warning" role="alert">No Reschedule Request for this business.</div>
                </div>
              @else
              <div class="row">
              <div class="col-sm-12">
                 <form method="post" enctype="multipart/form-data" >
                   @csrf
                   <input type="hidden" name="event_id" value="{{$rescheduleRequest->event_id}}">
                  <table class="table cstm-admin-table">
                   <thead>
                    <tr>
                       <th>Reschedular</th>
                       <th colspan="2">Action</th>
                    </tr>
                  </thead>

                        <tbody>  <tr>
                            <td>
                             Get a request to Reschedule the event. Start date of event - {{date("Y-m-d",strtotime($dates->start_date))}} and End date of event -  {{date("Y-m-d",strtotime($dates->end_date))}} 
                            </td>
                             
                              @if($eventcount ==  $vendorcount)
                              <td>
                              <button type="submit" class="btn btn-primary" style="pointer-events: none;cursor: default;" >Agreed</button>
                              </td>
                                <td>
                               <button type="submit" class="btn btn-primary" style="pointer-events: none;cursor: default;" >Cancel</button>
                               </td>
                              @else
                              <td>
                             <button type="submit" class="btn btn-primary" name="agreed" value="agreed" >Agree</button>
                             </td>
                              <td>
                              <button type="submit" class="btn btn-primary" name="cancel" value="cancel" >Cancel</button>
                            </td>
                             @endif
                         </tr>
                      </tbody>   
                 
                    
                  </table>
                     </form>
                  </div>
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
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
