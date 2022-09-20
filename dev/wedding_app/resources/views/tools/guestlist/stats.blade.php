<div class="col-lg-4 col-sm-4">
	<div class="form-group">
		<h4>You’ve invited 1231</h4>
		<span class="invite_number">{{count($user_event_guests)}}</span>
	</div>
	<div class="form-group">
		<label class="form-label" id="toggle-label">Open Event</label>
		<div class="checkbox switcher">
      <label for="test">
        <input type="checkbox" id="test" class="toggle-check" value="">
        <span><small></small></span>
      </label>
    </div>
	</div>
</div>
<div class="col-lg-6 col-sm-8">
	<div class="row">
		<div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round" id="ComingGuest" 
                 		@if(count($user_event_guests) > 0)
				          	data-value=".{{round((count($guests_attending)*100)/count($user_event_guests))}}"
				        @else
				        	data-value=".0"
				        @endif
				          total-value="{{count($user_event_guests)}}"
				          data-size="100"
				          data-thickness="10">
				          <strong class="progress-value"><span></span>{{count($guests_attending)}}</strong>				       
				    </div>
                </div>
                <h3>Attending</h3>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="progress-status-card">				
                <div class="progress-box">
                 	<div class="round" id="DeclinesGuest" 
                 		@if(count($user_event_guests) > 0)
				          data-value=".{{round((count($guests_declined)*100)/count($user_event_guests))}}"
				        @else
				        	data-value=".0"
				        @endif
				          data-size="100"
				          data-thickness="10">
				          <strong class="progress-value"><span></span>{{count($guests_declined)}}</strong>   
				    </div>
                </div>
                <h3>Declined</h3>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="progress-status-card">				
                <div class="progress-box">
                 	<div class="round" id="PendingGuest" 
                 		 @if(count($user_event_guests) > 0)
				          data-value=".{{round((count($guests_pending)*100)/count($user_event_guests))}}"
				         @else
				         	data-value=".0"
				         @endif
				          data-size="100"
				          data-thickness="10">
				          <strong class="progress-value"><span></span>{{count($guests_pending)}}</strong>   
				    </div>
                </div>
                <h3>Pending</h3>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="progress-status-card">
                <div class="progress-box">
                 	<div class="round" id="ComingGuestPercentage" 
                 		@if(count($user_event_guests) > 0)
				          	data-value=".{{round((count($guests_attending)*100)/count($user_event_guests))}}"
				        @else
				        	data-value=".0"
				        @endif
				          total-value="{{count($user_event_guests)}}"
				          data-size="100"
				          data-thickness="10">
				          <strong class="progress-value"><span></span>
				          	@if(count($user_event_guests) > 0)
				          		{{round((count($guests_attending)*100)/count($user_event_guests))}} %
				        	@else
				        		0
				        	@endif
				    	</strong>				       
				    </div>
                </div>
                <h3>Attending Percentage</h3>
			</div>
		</div>
    </div>
</div>