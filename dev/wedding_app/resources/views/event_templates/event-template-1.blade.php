<?php 
   $event_title   = $event_data->title;
   $event_address = $event_data->location;
   $event_amount  = $event_data->amount;

   $event_start_date_obj = \Carbon\Carbon::parse($event_data->start_date);
   $event_start_time_obj = \Carbon\Carbon::parse($event_data->start_time);
   $event_end_date_obj   = \Carbon\Carbon::parse($event_data->end_date);
   $event_end_time_obj   = \Carbon\Carbon::parse($event_data->end_time);

   $event_start_day      = $event_start_date_obj->format('l');
   $event_start_month    = $event_start_date_obj->formatLocalized('%b');
   $event_start_date     = $event_start_date_obj->formatLocalized('%d');
   $event_start_year     = $event_start_date_obj->formatLocalized('%Y');
   $event_start_time     = $event_start_time_obj->format('g:i A');

   $event_end_day        = $event_end_date_obj->format('l');
   $event_end_month      = $event_end_date_obj->formatLocalized('%b');
   $event_end_date       = $event_end_date_obj->formatLocalized('%d');
   $event_end_year       = $event_end_date_obj->formatLocalized('%Y');
   $event_end_time       = $event_end_time_obj->format('g:i A');

   $event_reg_amount = $event_reg->amount;
   

   $event_template_name             = $event_template->template_name ?? '';;
   $event_template_text             = $event_template->template_text ?? '';
   $template_backcover_text             = $event_template->template_backcover_text ?? '';
   $event_template_background_image = isset($event_template->background_image) ? asset($event_template->background_image) : '';
   $back_cover_background_picture = isset($event_template->background_image) ? asset($event_template->back_cover_background_picture) : '';
   
   $event_templatefont_color        = $event_template->font_color ?? '#fff';
   $event_back_font_colour        = $event_template->back_font_colour ?? '#fff';
   $logo_color        = $event_template->logo_color ?? '#fff';
   
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Ticket</title>
      <meta charset="UTF-8">
   </head>
   <body>
      <div>
         <table class="ticket-card-1" style="border: 1px solid #000; width: 625px; margin: 0 auto; border-collapse: collapse;background:url({{$event_template_background_image}});background-size: cover;">
            <tr>
               <td style="text-align: center;">
                  <table style="width:100%; border-collapse: collapse;">
                     <tr>
                        <td colspan="3" style="text-align: center;">
                           <img src="https://www.eplame.com/dev/images/ticket/logo-new.png" style="background:{{$logo_color}};width:150px;" alt="Logo">
                           <p style="font-size:14px;margin: 0;color: {{$event_templatefont_color}};"> {{$event_address}} </p>
                           <h5 style="font-size: 48px; margin-top: 5px; margin-bottom: 5px;  font-weight: 500; color: {{$event_templatefont_color}};"> {{$event_title}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; width:100px;text-align: center;">
                           <p style="margin:0;margin-bottom:5px;color: {{$event_templatefont_color}};"> {{$event_end_month}} <span style="font-size:20px;color: {{$event_templatefont_color}};">{{$event_end_day}} </span> {{$event_end_year}} </p>
                           <p style="margin:0;margin-bottom:5px;color: {{$event_templatefont_color}};"> Starts at {{$event_end_time}} </p>
                        </td>
                        <td style="border: 1px solid #000;width:100px;text-align: center;">
                           <p style="margin:0;font-size: 27px;padding: 0 5px;text-transform: uppercase;color: {{$event_templatefont_color}};"> Admit One</p>
                        </td>
                        <td style="border: 1px solid #000;width:100px;text-align: center;">
                           <p style="margin:0;color: {{$event_templatefont_color}};"> Ticket </p>
                           <p style="margin:0;color: {{$event_templatefont_color}};"> {{$event_reg_amount}}$ </P>
                        </td>
                     </tr>
                     <tr>
                         <td colspan="3" style="text-align: center;"><p style="margin:15px 0;color: {{$event_templatefont_color}};">{{$event_template_text}}</p></td>
                     </tr>   
                  </table>
               </td>
               <td style="border:1px solid #000">
                  <div style="transform: rotate(-90deg); text-align: center;">
                     <p style="margin:0;color: {{$event_templatefont_color}};"> ${{$event_reg_amount}} </p>
                     <h5 style="margin:0; margin-top:10px;color: {{$event_templatefont_color}};"> {{$event_title}}</h5>
                     <p style="margin:0; margin-top:10px;color: {{$event_templatefont_color}};"> {{$event_end_month}} {{$event_end_day}} {{$event_end_year}} </p>
                  </div>
               </td>
            </tr>
         </table>
         <table style="border: 1px solid #000; width: 625px; margin: 0 auto; margin: 20px auto; border-collapse: collapse;background:url({{$back_cover_background_picture}});background-size: cover;">
            <tr>
               <td>
                  <p style="text-align:center;margin-bottom: 200px;color:{{$event_back_font_colour}}">{{$template_backcover_text}}</p>
               </td>
            </tr>
        </table>
      </div>
   </body>
</html>