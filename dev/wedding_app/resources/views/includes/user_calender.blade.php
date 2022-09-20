@if(Auth::check() && Auth::user()->role == 'user')
 <!-- <a href="javascript:void(0);" id="calender-toggle"> <span>
 	<i class="fas fa-calendar-alt"></i></span>
 	<div class="cstm-tooltip tooltip-right">Start Planning Here, Choose a Date</div>
 </a> -->
 @endif