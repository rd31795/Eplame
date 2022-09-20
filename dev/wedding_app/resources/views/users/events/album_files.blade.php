	 

@php $imagess = \App\Models\UserEventAlbum::where('event_id',$event->first()->id)->where('type', '!=', 'video')->paginate(20);  @endphp
@if(!empty($imagess) && count($imagess) > 0)
     @foreach($imagess as $img)
            <div class="col-lg-4">
                <div class="gallery-card">
                  <div class="image-gallery-container">
                       <img src="{{url($img->file_link)}}" width="100%">
                      
                   <div class="card-info">
                        
                        <ul class="acrdn-action-btns">
                           
                          <li><a data-toggle="tooltip" title="Delete" onclick="deleteItem(this)" href="javascript:void(0)" 
                            data-delurl="{{route('user.event.album.delete',[$event->first()->slug,$img->id])}}" class="action_btn deleteBtn danger-btn"><i class="fas fa-trash-alt"></i></a></li>
                     </ul>
              </div>
                    

                  </div>
                </div>
            </div>
          @endforeach



<div class="col-md-12"> 
     
       {{$imagess->links()}}
    
    </div>     
@else
                  <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">Your Image Gallery have not images yet.</div>
                  </div>
@endif

