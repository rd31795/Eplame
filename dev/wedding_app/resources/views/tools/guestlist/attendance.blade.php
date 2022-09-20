<div class="table-responsive">
	<table class="table guestlist-table">
		<thead>
			<tr>
				<th>Attending</th>
				<th>ATTENDANCE</th>
				<th>Menu</th>
				<th class="action-btns">
				</th>
			</tr>
		</thead>
		<tbody>
			@if(!empty($user_event_attending[0]->id))
				@foreach($user_event_attending as $user_attending)
				<tr>
					<td>
	    					<div class="tr-username"><span class="tr-usericon"><img src="{{url('/images/user.jpg')}}"><span class="status-dot de-active-dot"></span></span>{{$user_attending->fname}} @if($user_attending->type == 1)<span class="tax">Registered User</span>@else <span class="tax">Invited User</span>@endif</div>
	    			</td>
					<td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          @if($user_attending->attendance == 0)
				          	Pending
				          @elseif($user_attending->attendance == 1)
				          	Attending
				          @else
				          	Declined
				          @endif
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_attending->id}}" data-label="attendance" data-value="1">Attending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_attending->id}}" data-label="attendance" data-value="0">Pending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_attending->id}}" data-label="attendance" data-value="2">Declined</a>
				        </div>
				      </div>
				  </td>
				  <td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          {{$user_attending->guestMenu->menu_label}}
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          @if(!empty($user_event_menus[0]->id))
	                  		@foreach($user_event_menus as $user_event_menu)
	                  	  	<a class="dropdown-item update-opt" href="javascript:void(0)" data-value="{{$user_event_menu->id}}" data-id="{{$user_attending->id}}" data-label="menu">{{$user_event_menu->menu_label}}</a>
	                  	  	@endforeach
	                  	@else
	                  		<option value="">Please add a menu</option>
	              	  	@endif										        
				        </div>
				      </div>
				  </td>
				  <td>
				  	<div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle remove-downarrow" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				         <i class="fas fa-ellipsis-v"></i>
				     </a>
				       
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				         
				          <a class="dropdown-item guest-edit" href="javascript:void(0)" data-toggle="modal" data-target="#AddGuestGroup" data-id="{{$user_attending->id}}" data-fname="{{$user_attending->fname}}" data-lname="{{$user_attending->lname}}" data-gender="{{$user_attending->gender}}" data-age="{{$user_attending->age}}" data-menu="{{$user_attending->menu}}" data-group="{{$user_attending->group}}" data-email="{{$user_attending->email}}" data-contact_no="{{$user_attending->contact_no}}">Edit</a>
				          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$user_attending->id}}" data-label="guest">Remove</a>
				         
				        </div>
				      </div>
				  </td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4"> No Guest Found</td>
				</tr>
			@endif
		</tbody>
	</table>
	<table class="table guestlist-table">
		<thead>
			<tr>
				<th>Pending</th>
				<th>ATTENDANCE</th>
				<th>Menu</th>
				<th class="action-btns">
					
				</th>
			</tr>
		</thead>
		<tbody>
				@if(!empty($user_event_pending[0]->id))
				@foreach($user_event_pending as $user_pending)
				<tr>
					<td>
	    					<div class="tr-username"><span class="tr-usericon"><img src="http://49.249.236.30:6644/bms/files/logo/1585565977x5cXsdrJIF7q1MDjZ2k0download.png"><span class="status-dot de-active-dot"></span></span>{{$user_pending->fname}}</div>
	    				</td>
					<td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          @if($user_pending->attendance == 0)
				          	Pending
				          @elseif($user_pending->attendance == 1)
				          	Attending
				          @else
				          	Declined
				          @endif
				        </a>
				        <div class="dropdown-menu update-opt" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_pending->id}}" data-label="attendance" data-value="1">Attending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_pending->id}}" data-label="attendance" data-value="0">Pending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_pending->id}}" data-label="attendance" data-value="2">Declined</a>
				        </div>
				      </div>
				  </td>
				  <td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          {{$user_pending->guestMenu->menu_label}}
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          @if(!empty($user_event_menus[0]->id))
	                  		@foreach($user_event_menus as $user_event_menu)
	                  	  	<a class="dropdown-item update-opt" href="javascript:void(0)" data-value="{{$user_event_menu->id}}" data-id="{{$user_pending->id}}" data-label="menu">{{$user_event_menu->menu_label}}</a>
	                  	  	@endforeach
	                  	@else
	                  		<option value="">Please add a menu</option>
	              	  	@endif										        
				        </div>
				      </div>
				  </td>
				  <td>
				  	<div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle remove-downarrow" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				         <i class="fas fa-ellipsis-v"></i>
				     </a>
				       
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item guest-edit" href="javascript:void(0)" data-toggle="modal" data-target="#AddGuestGroup" data-id="{{$user_pending->id}}" data-fname="{{$user_pending->fname}}" data-lname="{{$user_pending->lname}}" data-gender="{{$user_pending->gender}}" data-age="{{$user_pending->age}}" data-menu="{{$user_pending->menu}}" data-group="{{$user_pending->group}}" data-email="{{$user_pending->email}}" data-contact_no="{{$user_pending->contact_no}}">Edit</a>
				          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$user_pending->id}}" data-label="guest">Remove</a>
				         
				        </div>
				      </div>
				  </td>
				</tr>
				@endforeach
			@else
			<tr>
				<td colspan="4"> No Guest Found</td>
			</tr>
			@endif
		</tbody>
	</table>
	<table class="table guestlist-table">
		<thead>
			<tr>
				<th>Declined</th>
				<th>ATTENDANCE</th>
				<th>Menu</th>
				<th class="action-btns">
					
				</th>
			</tr>
		</thead>
		<tbody>
			@if(!empty($user_event_declined[0]->id))
				@foreach($user_event_declined as $user_declined)
				<tr>
					<td>
	    					<div class="tr-username"><span class="tr-usericon"><img src="http://49.249.236.30:6644/bms/files/logo/1585565977x5cXsdrJIF7q1MDjZ2k0download.png"><span class="status-dot de-active-dot"></span></span>{{$user_declined->fname}}</div>
	    				</td>
					<td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          @if($user_declined->attendance == 0)
				          	Pending
				          @elseif($user_declined->attendance == 1)
				          	Attending
				          @else
				          	Declined
				          @endif
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_declined->id}}" data-label="attendance" data-value="1">Attending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_declined->id}}" data-label="attendance" data-value="0">Pending</a>
				          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$user_declined->id}}" data-label="attendance" data-value="2">Declined</a>
				        </div>
				      </div>
				  </td>
				  <td>
					  <div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          {{$user_declined->guestMenu->menu_label}}
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          @if(!empty($user_event_menus[0]->id))
	                  		@foreach($user_event_menus as $user_event_menu)
	                  	  	<a class="dropdown-item update-opt" href="javascript:void(0)" data-value="{{$user_event_menu->id}}" data-id="{{$user_declined->id}}" data-label="menu">{{$user_event_menu->menu_label}}</a>
	                  	  	@endforeach
	                  	@else
	                  		<option value="">Please add a menu</option>
	              	  	@endif										        
				        </div>
				      </div>
				  </td>
				  <td>
				  	<div class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle remove-downarrow" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				         <i class="fas fa-ellipsis-v"></i>
				     </a>
				       
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item guest-edit" href="javascript:void(0)" data-toggle="modal" data-target="#AddGuestGroup" data-id="{{$user_declined->id}}" data-fname="{{$user_declined->fname}}" data-lname="{{$user_declined->lname}}" data-gender="{{$user_declined->gender}}" data-age="{{$user_declined->age}}" data-menu="{{$user_declined->menu}}" data-group="{{$user_declined->group}}" data-email="{{$user_declined->email}}" data-contact_no="{{$user_declined->contact_no}}">Edit</a>
				          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$user_declined->id}}" data-label="guest">Remove</a>
				         
				        </div>
				      </div>
				  </td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4"> No Guest Found</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
<style type="text/css">
  span.tax {
    font-size: 10px;
    padding-left: 4px;
</style>