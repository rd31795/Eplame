 <table style="width:100%" border="1" cellpadding="10" cellspacing="0">

 <tr>
   
     			<th style="text-align: left;">Expense</th>
     			<th style="text-align: left;">Estimated Budget</th>
     			<th style="text-align: left;">Final Budget</th>
          <th style="text-align: left;">Paid Money</th>
     		 
 
</tr>	 
@if(!empty($budgetEntries[0]->id))
  @foreach($budgetEntries as $enteries)

 <tr>
   
     			<td style="text-align: left;">{{$enteries->catagory_label}}</td>
     			<td style="text-align: left;">{{$enteries->estimated_budget}}</td>
     			<td style="text-align: left;">{{$enteries->final_budget}}</td>
     			<td style="text-align: left;">{{$enteries->paid_money}}</td>
     		 
 
</tr>
  @endforeach
@endif

</table>
  