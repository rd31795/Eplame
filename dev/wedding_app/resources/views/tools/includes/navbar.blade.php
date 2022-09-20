@php
if(!empty($event->slug)){
    $slug = $event->slug;
}
else{
    $slug = $user_event->slug;
}
@endphp
<section class="new-aside">
    <div class="container">
        <div class="tab-wrap">
            <div class="small-nav">
                <div class="tab-button">
                    <div>
                        <a href="javascript:void(0);" title="Open Navigation">
                            <span class="service-icon show-icons"><i class="fas fa-play"></i></span>
                        </a>
                    </div>
                </div>

                <div class="tab-button">
                    <div>
                        <a href="{{url(route('user.tool.checklist',$slug))}}" class="activelink" title="Checklist">
                            <span class="service-icon"><i class="fas fa-list"></i></span>
                        </a>
                    </div>
                </div>
                
                <div class="tab-button">
                    <div>
                        <a href="{{url(route('users.events.vendors',$slug))}}" class="" title="Vendor Manager">
                            <span class="service-icon"><i class="fas fa-folder-open"></i></span>
                            
                        </a>
                    </div>
                </div>

                <div class="tab-button">
                    <div>
                        <a href="{{url(route('users.guestList',$slug))}}" class="" title="Guest List">
                            <span class="service-icon"><i class="fas fa-users"></i></span>
                            
                        </a>
                    </div>
                </div>
          
                <div class="tab-button">
                    <div> 
                        <a href="{{url(route('users.budget',$slug))}}" class="" title="Budget">
                            <span class="service-icon"><i class="fas fa-calculator"></i></span>
                        </a>
                    </div>
                </div>

                <div class="tab-button">
                    <div> 
                        <a href="{{url(route('user_show_detail_event',$slug))}}" class="" title="Event Detail">
                            <span class="service-icon"><i class="fas fa-step-backward"></i></span>
                        </a>
                    </div>
                </div>
          
            </div>

            <div class="big-nav">
                <a href="javascript:script:void(0);" class="go-back"><i class="fas fa-times"></i></a>
                    
                <div class="tab-button">
                    <div class="tab-item1">
                        <a href="{{url(route('user.tool.checklist',$slug))}}" class="activelink">
                            <span class="service-icon"><i class="fas fa-list"></i></span>
                            <h3>Checklist</h3>
                        </a>
                    </div>
                </div>
          
                <div class="tab-button">
                    <div class="tab-item1">
                        <a href="{{url(route('users.events.vendors',$slug))}}" class="">
                            <span class="service-icon"><i class="fas fa-folder-open"></i></span>
                            <h3>Vendor Manager</h3>
                        </a>
                    </div>
                </div>
          
                <div class="tab-button">
                    <div class="tab-item1"> 
                        <a href="{{url(route('users.guestList',$slug))}}">
                            <span class="service-icon"><i class="fas fa-users"></i></span>
                            <h3>Guest List</h3>
                        </a>
                    </div>
                </div>
          
                <div class="tab-button">
                    <div class="tab-item1">
                        <a href="{{url(route('users.budget',$slug))}}" class="">
                            <span class="service-icon"><i class="fas fa-calculator"></i></span>
                            <h3>Budget</h3>
                        </a>
                    </div>
                </div> 

                <div class="tab-button">
                    <div class="tab-item1">
                        <a href="{{url(route('user_show_detail_event',$slug))}}" class="">
                            <span class="service-icon"><i class="fas fa-step-backward"></i></span>
                            <h3>Event Detail</h3>
                        </a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>