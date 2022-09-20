<div class="summary-card" id="additional-info-sec">
	<div class="pannel-card">	
		<div class="card-heading">
			<h3>{{ getBasicInfo($vendor->vendors->id, $vendor->category_id,'additional_information','label') }}</h3>			
		</div>		
		<div class="summary-details-content">
      {!! getBasicInfo($vendor->vendors->id, $vendor->category_id,'additional_information','detail') !!}
		</div>
	</div>
</div>