 <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                </div>
                              
                                <div class="front-cover-content">
                                    <div class="ticket-card-2 d-flex">
                                        <div class="cs-left" id="logoPreview1"    style="background-image:url('{{url($template->background_image)}}'); color:{{$template->font_color}};">
                                    <div class="ticket-logo">
                                       <img src="{{url('images/ticket/logo-new.svg')}}" style="background: {{$template->logo_color}}">
                                    </div>
                                    <div class="ticket-2-content theme-color-header" style="background-color:{{$template->theme_color}}b3;">
                                    <div id="header_content"  >   
                                       {!!$template->header_content!!}
                                    </div>
                                   <div id="ticket_event_location">
                                            <p>DJ MORRIL POTTER NEW YORK,</p>
                                    </div>
                                    <p class="p-cntnt" id="ticket-text">{{$template->template_text}}</p>
                                    </div>
                                 </div>
                                        <div class="cs-right " id="ticket-right-side" style="color:{{$template->font_color}};  background-color: {{$template->ticket_right_side}}">
                                    <div class="text-center">
                                       <h2 style="font-size: 18px; color:{{$template->font_color}}"  id="ticket_event_title">EVENT TITLE</h2>
                                       <hr class="border_color_theme">
                                            <ul class="mt-2">
                                                <li>
                                                  <p><span id="ticket_event_dates">23-1-2018</span></p>
                                                </li>
                                                <li>
                                                    <p><span id="ticket_event_timings">7:00PM</span></p>
                                                </li>
                                            </ul>
                                       <p class="p-cntnt cs-p-cntnt "><span>
                                          <span id="ticket_type" style=" text-transform: uppercase;">VIP</span> GATE PASS
                                       </span>     
                                    #3R34R43ASFD</p>
                                    </div>
                                    <div class="cs-rows-wrapper">
                                      
                                    </div>
                                 </div>
                                    </div>
                                </div>
                               <hr style="border-top: dotted 1px;">
                                 <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack" style="background-image:url('{{url($template->back_cover_background_picture)}}'); color: white;">
                                            <div id="ticket-backcover-text">{!! $template->template_backcover_text !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>