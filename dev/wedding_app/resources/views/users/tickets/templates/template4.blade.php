   <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="front-cover-content">
                                    <div class="ticket-card-5 d-flex">
                                        <div class="cs-left" id="logoPreview1" style="background-image:url('{{url($template->background_image)}}'); color:{{$template->font_color}};">
                                            <div class="cs-card-left-img">
                                                <img src="{{url($template->picture)}}" id="front_event_picture">
                                            </div>
                                            <div>
                                                <div class="ticket-logo">
                                                    <img src="{{url('images/ticket/logo-new.svg')}}" style="background: {{$template->logo_color}};">
                                                </div>
                                                <div id="header_content">
                                               {!!$template->header_content!!}
                                                </div>
                                                <ul>
                                                    <li>
                                                        <div class="fourth-ticket">
                                                            <h6>Date</h6>
                                                            <p><span id="ticket_event_dates">23-1-2018</span></p>
                                                            <br>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h6>Time</h6>
                                                        <div class="fourth-ticket d-flex justify-content-between">
                                                            <div class="mr-2">
                                                                
                                                                <p>DOOR OPEN</p>
                                                                <h6><strong><span id="door_open_time">09:00 PM</span></strong></h6>
                                                            </div>
                                                            <div>
                                                                
                                                                <p>DOOR CLOSE</p>
                                                                <h6><strong><span id="door_close_time">09:00 PM</span></strong></h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cs-right" id="ticket-right-side" style="color:{{$template->font_color}};  background-color: {{$template->ticket_right_side}}">
                                            <div class="cs-right-inner">
                                                <h6 style="font-size: 18px; color:{{$template->font_color}}"  id="ticket_event_title">EVENT NAME</h6>
                                                <h5><span id="ticket_type" style=" text-transform: uppercase;">VIP</span> GAT PASS</h5>
                                                <h5>000055446</h5>
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