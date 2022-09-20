@if(!empty($reviews))
<div class="ReviewRating-sec" id="review-sec">
	<div class="pannel-card">
		<div class="card-heading">
			<h3>Review & Rating</h3>			
		</div>		

    @php 
          $total_reviews_rating = (count($reviews));
          $total_review = 0;
          if(!empty($reviews[0]->id)){
            foreach($reviews as $review){
              $total_review = $total_review + $review->rating;
            }
          }
          if($total_reviews_rating > 0){
            $avg = number_format($total_review/$total_reviews_rating, 1);
            $percent = ($total_reviews_rating / 100);
            $total1 = count($reviews1) > 0 ? round(count($reviews1) / $percent) : 0;
            $total2 = count($reviews2) > 0 ? round(count($reviews2) / $percent) : 0;
            $total3 = count($reviews3) > 0 ? round(count($reviews3) / $percent) : 0;
            $total4 = count($reviews4) > 0 ? round(count($reviews4) / $percent) : 0;
            $total5 = count($reviews5) > 0 ? round(count($reviews5) / $percent) : 0;
          }else{
            $avg = 0;
            $total1 = 0;
            $total2 = 0;
            $total3 = 0;
            $total4 = 0;
            $total5 = 0;
          }

        @endphp

		<div class="rating-content">
			    <div class="rating-container">
    <div class="rating-head">                
        <span class="rating-heading">User Rating</span>
      <div class="Stars" style="--rating: {{$avg}};" aria-label="Rating of this product is {{$avg}} out of 5.">

       </div>
    </div>
     <div class="total-review-cal"><p>{{$avg}} average based on {{count($reviews)}} reviews.</p></div>
        <hr style="border:2px solid #f1f1f1">

        <div class="rating-bar-row">
          <div class="single-rating-row">
          <div class="side">
            <div>5 star</div>
          </div>
          <div class="middle">
            <div class="bar-container">
              <div class="bar-5" style="width:{{$total5}}%"></div>
            </div>
          </div>
          <div class="side right">
            <div>{{count($reviews5)}}</div>
          </div>
        </div>

       <div class="single-rating-row">
          <div class="side">
            <div>4 star</div>
          </div>
          <div class="middle">
            <div class="bar-container">
              <div class="bar-4" style="width:{{$total4}}%"></div>
            </div>
          </div>
          <div class="side right">
            <div>{{count($reviews4)}}</div>
          </div>
        </div>

        <div class="single-rating-row">
          <div class="side">
            <div>3 star</div>
          </div>
          <div class="middle">
            <div class="bar-container">
              <div class="bar-3" style="width:{{$total3}}%"></div>
            </div>
          </div>
          <div class="side right">
            <div>{{count($reviews3)}}</div>
          </div>
        </div>

        <div class="single-rating-row">
          <div class="side">
            <div>2 star</div>
          </div>
          <div class="middle">
            <div class="bar-container">
              <div class="bar-2" style="width:{{$total2}}"></div>
            </div>
          </div>
          <div class="side right">
            <div>{{count($reviews2)}}</div>
          </div>
        </div>

       <div class="single-rating-row">
          <div class="side">
            <div>1 star</div>
          </div>
          <div class="middle">
            <div class="bar-container">
              <div class="bar-1" style="width:{{$total1}}%"></div>
            </div>
          </div>
          <div class="side right">
            <div>{{count($reviews1)}}</div>
          </div>
        </div>
        </div>
    </div>


        <div class="user-rating-sec">
          @if(!empty($reviews[0]->id))
            @foreach($reviews as $review)
            	<div class="user-rating-card">
                 <div class="row">
                     <div class="col-md-3">
                         <div class="rating-user-detail">
                             <figure>
                                @if(!empty($review->businessreviewUserId->profile_image))
                                  <img src="{{asset('').'/'.$review->businessreviewUserId->profile_image}}">
                                @else
                                  <img src="{{url('/')}}/images/faceless.jpg">
                                @endif
                             </figure>
                             <h5>{{$review->businessreviewUserId->name}}</h5>
                             <div class="review-block-date"><p>{{ \Carbon\Carbon::parse($review->updated_at)->format('d-m-Y') }}<br>{{ \Carbon\Carbon::parse($review->updated_at)->diffForhumans()}}</p></div>
                         </div>
                     </div>
                     <div class="col-md-9">
                        <div class="rating-content"> 
                           <div class="review-block-rate">
                            @for($i = 0; $i < 5; $i++)
                              <span class="btn @if($i<$review->rating) btn-warning @else btn-default btn-grey @endif btn-xs" aria-label="Left Align">
                                <span class="fas fa-star" aria-hidden="true"></span>
                              </span>

                            @endfor
                            @if(!empty($review->images))
                              <figure data-toggle="modal" data-target="#cust-light" class="cust-light-box" data-src="{{ url('/').'/wedding_app/public/uploads/'.$review->images}}">
                                <img src="{{ url('/').'/wedding_app/public/uploads/'.$review->images}}">
                              </figure>
                            @endif
                          </div>
                          <div class="review-block-title">{{$review->title}}</div>
                          <div class="review-block-description">{{$review->summary}}</div>
                        </div>
                     </div>
                 </div>
            </div>
        @endforeach
      @endif

    </div>
		</div>
	</div>
</div>

<!-- modalbox -->
<!-- Modal -->
<div class="modal fade" id="cust-light" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <figure>
          <img src="" class="img-pop">
        </figure>
      </div>
      
  </div>
</div>
</div>
   @endif