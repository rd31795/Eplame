<div class="table-responsive">
	@if(!empty($user_event_groups[0]->id))
    	@foreach($user_event_groups as $group)
	    	<table class="table guestlist-table">
	    		<thead>
	    			<tr>
	    				<th>{{$group->group_label}}</th>
	    				<th>ATTENDANCE</th>
	    				<th>Menu</th>
	    				<th class="action-btns"> 
	    					@if($group->group_label != 'unassigned')
	    					<div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle remove-downarrow" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						         <i class="far fa-edit"></i>
						     </a>
						       
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item group-edit" href="javascript:void(0)" data-id="{{$group->id}}" data-toggle="modal" data-target="#GuestGroup" data-value="{{$group->group_label}}">Edit</a>
						          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$group->id}}" data-label="group">Remove</a>
						         
						        </div>
						        
						      </div>
						      @endif
	    				</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			@php $group_guests = getGroupGuests($group->user_event_id, $group->id, $search_text);
	    			@endphp

	    			@if(!empty($group_guests[0]->id))
	    				@foreach($group_guests as $group_guest)
		    			<tr>
		    				<td>
		    					<div class="tr-username"><span class="tr-usericon"><img src="{{url('/images/user.jpg')}}"><span class="status-dot de-active-dot"></span></span>{{$group_guest->fname}}@if($group_guest->type == 1)<span class="tax">Registered User</span>@else <span class="tax">Invited User</span>@endif</div>
		    				</td>
		    				<td>
		    				  <div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          @if($group_guest->attendance == 0)
						          	Pending
						          @elseif($group_guest->attendance == 1)
						          	Attending
						          @else
						          	Declined
						          @endif
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_guest->id}}" data-label="attendance" data-value="1">Attending</a>
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_guest->id}}" data-label="attendance" data-value="0">Pending</a>
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_guest->id}}" data-label="attendance" data-value="2">Declined</a>
						        </div>
						      </div>
						  </td>
						  <td>
		    				  <div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          {{$group_guest->guestMenu->menu_label}}
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          @if(!empty($user_event_menus[0]->id))
			                  		@foreach($user_event_menus as $user_event_menu)
			                  	  	<a class="dropdown-item update-opt" href="javascript:void(0)" data-value="{{$user_event_menu->id}}" data-id="{{$group_guest->id}}" data-label="menu">{{$user_event_menu->menu_label}}</a>
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
						          <a class="dropdown-item guest-edit" href="javascript:void(0)" data-toggle="modal" data-target="#AddGuestGroup" data-id="{{$group_guest->id}}" data-fname="{{$group_guest->fname}}" data-lname="{{$group_guest->lname}}" data-gender="{{$group_guest->gender}}" data-age="{{$group_guest->age}}" data-menu="{{$group_guest->user_event_menu_id}}" data-group="{{$group_guest->user_event_group_id}}" data-email="{{$group_guest->email}}" data-contact_no="{{$group_guest->contact_no}}">Edit</a>
						          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$group_guest->id}}" data-label="guest">Remove</a>
						         
						        </div>
						      </div>


						  </td>
		    			</tr>
		    			@endforeach
		    		@else
		    			<tr>
		    				<td colspan="4">
		    					No Guest Found
		    				</td>
		    			</tr>
		    		@endif
	    		</tbody>
	    	</table>
	    @endforeach
	@endif
</div>
<style type="text/css">
  span.tax {
    font-size: 10px;
    padding-left: 4px;
</style>