<div class="col-lg-12 col-sm-12 mt-4">
	<div class="row">
		@foreach($registration_type as $key=>$value)

           <div class="col-sm-3">
           	  <h3 style="text-transform: uppercase; "><strong>{{$value->reg_type}} Ticket</strong></h3>
           </div>
		   <div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round commandstats" id="{{$value->reg_type}}_{{$value->occupied_seats}}"
				          data-value=".{{round($value->occupied_seats*100)/$value->seats}}" total-value="{{$value->seats}}" data-size="100" data-thickness="10">
				          <strong class="progress-value"><span></span>{{$value->occupied_seats}}</strong>				       
				    </div>
                </div>
                <h3>Alloted Slots</h3>
			</div>
		</div>


		  <div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round commandstats" id="{{$value->reg_type}}_{{$value->available_seats}}"
				          data-value=".{{round($value->available_seats*100)/$value->seats}}" total-value="{{$value->seats}}" data-size="100" data-thickness="10">
				          <strong class="progress-value"><span></span>{{$value->available_seats}}</strong>				       
				    </div>
                </div>
                <h3>Pending Slots</h3>
			</div>
		   </div>


		<div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round commandstats" id="{{$value->reg_type}}"
				          data-value=".{{round($value->occupied_seats*100)/$value->seats}}" total-value="{{$value->seats}}" data-size="100" data-thickness="10">
				          <strong class="progress-value"><span></span>{{round($value->occupied_seats*100)/$value->seats}}%</strong>				       
				    </div>
                </div>
                <h3>Attending Percentage</h3>
			</div>
		   </div>

		<!-- <div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round ComingGuest2"
				          data-value=".80" total-value="5" data-size="100" data-thickness="10">
				          <strong class="progress-value"><span></span>10</strong>				       
				    </div>
                </div>
                <h3>Pending Slots</h3>
			</div>
		</div> -->
	<!-- 	<div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round ComingGuest2"
				          data-value=".80" total-value="5" data-size="100" data-thickness="10">
				          <strong class="progress-value"><span></span>10</strong>				       
				    </div>
                </div>
                <h3>Total Slots</h3>
			</div>
		</div> -->
		@endforeach
		
    </div>
</div>