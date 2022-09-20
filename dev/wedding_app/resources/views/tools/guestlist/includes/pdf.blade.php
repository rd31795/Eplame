 <table style="width:100%" border="1" cellpadding="3" cellspacing="0">

 <tr>
   
     			<th style="text-align: left;">Name</th>
     			<th style="text-align: left;">Attendance</th>
     			<th style="text-align: left;">Contact</th>
          <th style="text-align: left;">Group</th>
          <th style="text-align: left;">Menu</th>
     		 
 
</tr>	 
@if(!empty($guestlistEntries[0]->id))
  @foreach($guestlistEntries as $enteries)

 <tr>
   
     			<td style="text-align: left;">{{$enteries->fname}}</td>
          @if($enteries->attendance == 0)
            <td style="text-align: left;">Pending</td>
          @elseif($enteries->attendance == 1)
            <td style="text-align: left;">Attending</td>
          @else
            <td style="text-align: left;">Declined</td>
          @endif
     			
     			<td style="text-align: left;">{{$enteries->contact_no}}</td>

     			<td style="text-align: left;">{{$enteries->guestGroup->group_label}}</td>
          <td style="text-align: left;">{{$enteries->guestMenu->menu_label}}</td>
     		 
 
</tr>
  @endforeach
@endif

</table>
  