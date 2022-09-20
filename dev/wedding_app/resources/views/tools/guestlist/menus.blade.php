<div class="table-responsive">
@if(!empty($user_event_menus[0]->id))
	@foreach($user_event_menus as $menu)
    	<table class="table guestlist-table">
    		<thead>
    			<tr>
    				<th>{{$menu->menu_label}}</th>
    				<th>ATTENDANCE</th>
    				<th>Menu</th>

    				<th class="action-btns">
    					@if($menu->menu_label != 'unassigned')
    					<div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle remove-downarrow" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						         <i class="far fa-edit"></i>
						     </a>
						       
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item menu-edit" href="javascript:void(0)" data-id="{{$menu->id}}" data-value="{{$menu->menu_label}}" data-desription="{{$menu->menu_description}}" data-toggle="modal" data-target="#MenuGuestGroup">Edit</a>
						          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$menu->id}}" data-label="menu">Remove</a>
						         
						        </div>
						      </div>
						      @endif
    				</th>
    			</tr>
    		</thead>
    		<tbody>
    			@php $group_menus = getGroupMenus($menu->user_event_id, $menu->id, $search_text); @endphp
    			@if(!empty($group_menus[0]->id))
    				@foreach($group_menus as $group_menu)
	    			<tr>
	    				<td>
	    					<div class="tr-username"><span class="tr-usericon"><img src="{{url('/images/user.jpg')}}"><span class="status-dot de-active-dot"></span></span>{{$group_menu->fname}}</div>
	    				</td>
	    				<td>
		    				  <div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          @if($group_menu->attendance == 0)
						          	Pending
						          @elseif($group_menu->attendance == 1)
						          	Attending
						          @else
						          	Declined
						          @endif
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_menu->id}}" data-label="attendance" data-value="1">Attending</a>
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_menu->id}}" data-label="attendance" data-value="0">Pending</a>
						          <a class="dropdown-item update-opt" href="javascript:void(0)" data-id="{{$group_menu->id}}" data-label="attendance" data-value="2">Declined</a>
						        </div>
						      </div>
						  </td>
						  <td>
		    				  <div class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          {{$group_menu->guestMenu->menu_label}}
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          @if(!empty($user_event_menus[0]->id))
			                  		@foreach($user_event_menus as $user_event_menu)
			                  	  	<a class="dropdown-item update-opt" href="javascript:void(0)" data-value="{{$user_event_menu->id}}" data-id="{{$group_menu->id}}" data-label="menu">{{$user_event_menu->menu_label}}</a>
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
						          <a class="dropdown-item guest-edit" href="javascript:void(0)" data-toggle="modal" data-target="#AddGuestGroup" data-id="{{$group_menu->id}}" data-fname="{{$group_menu->fname}}" data-lname="{{$group_menu->lname}}" data-gender="{{$group_menu->gender}}" data-age="{{$group_menu->age}}" data-menu="{{$group_menu->user_event_menu_id}}" data-group="{{$group_menu->user_event_group_id}}" data-email="{{$group_menu->email}}" data-contact_no="{{$group_menu->contact_no}}">Edit</a>
						          <a class="dropdown-item remove-opt" href="javascript:void(0)" data-id="{{$group_menu->id}}" data-label="guest">Remove</a>
						         
						        </div>
						      </div>
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