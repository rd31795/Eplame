<style>
pre{
	color:{{$template->font_color}}
}
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="front-cover-content">
                                    <div class="ticket-card-3 d-flex">
                                        <!-- <div class="cs-left-img">
                                            <figure id="logoPreview1" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                            </figure>
                                        </div> -->
                                        <div class="cs-left" id="logoPreview1" style="background-image:url('{{url($template->background_image)}}'); color:{{$template->font_color}};">
                                            <div class="ticket-logo" >
                                                <img src="{{url('images/ticket/logo-new.svg')}}" style="background: {{$template->logo_color}}">
                                            </div>
                                           
                                            <div class="cs-mid text-center" style="background-color:{{$template->theme_color}}b3;" id="ticket_header_content">
                                                {!!$template->header_content!!}
                                            </div>
                                            <br>
                                            <div id="ticket_event_location">
                                            <p>DJ MORRIL POTTER NEW YORK,</p>
                                           </div>
                                        </div>
                                        <div class="cs-right" style="color:{{$template->font_color}};  background-color: {{$template->ticket_right_side}}">
                                            <div class="bg-layer" style="background-color:{{$template->theme_color}};"></div>
                                            <h5 class="cs-top" style="font-size: 18px; color:{{$template->font_color}}"  id="ticket_event_title">
                                                EVENT TITLE
                                            </h5>
                                            <ul>
                                                <li>
                                                    <p id="ticket_price_type"><span id="ticket_type" style=" text-transform: uppercase;">VIP</span>: <span id="ticket_price">$ ENTRY PASS</span></p>
                                                </li>
                                                <li>
                                                    <p>DATE: <span id="ticket_event_dates">23-1-2018</span></p>
                                                </li>
                                                <li>
                                                    <p>TIME: <span id="ticket_event_timings">7:00PM</span></p>
                                                </li>
                                                <li>
                                                    <p id="ticket_ticket-text">{{$template->template_text}}</p>
                                                </li>
                                            </ul>
                                            <div class="bg-layer" style="background-color:{{$template->theme_color}};"></div>
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