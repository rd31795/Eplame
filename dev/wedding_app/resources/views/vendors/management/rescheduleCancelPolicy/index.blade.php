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
          <a href="{{url(route($addLink, $slug))}}" class="add_btn"><i class="fa fa-plus"></i></a>
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
              @if( $policies == '')
                <div class="col-md-12">
                  <div class="alert alert-warning" role="alert">No Policy Information is added to this business.</div>
                </div>
              @else
              <div class="row">
              <div class="col-sm-6">
                @if(!empty($policies))
                {!! $policies->policy !!}
                @endif
              </div>
              <div class="col-sm-6">
                 @if(!empty($policies))
                  <table class="table cstm-admin-table">
                   <thead>
                    <tr>
                       <th>Days</th>
                       <th>Percentage</th>
                    </tr>
                  </thead>

                    @if(!empty($policies)) 
                 <?php $v = json_decode($policies->days_percentage);  ?>
                 @foreach($v->days as $key => $value)
                        <tbody>  <tr>
                            <td>
                              {{$value}}
                            </td>
                             <td>
                              {{$v->percentage[$key]}}
                            </td>
                         </tr>
                      </tbody>   
                    @endforeach
                     @endif
                  </table>
                      @endif
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
