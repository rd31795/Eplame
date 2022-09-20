<?php 
    // echo '<pre>';
    // print_r($event_template);
    // die();

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
    <title></title>
</head>
<body>

<table class="ticket-card-2" style="width: 700px; margin: 0 auto; border-collapse: collapse;">
  <tr>
    <td style="border-radius: 0 10px 10px 0;">                        
      <table style="border-radius: 0 10px 10px 0;width:100%;background:url({{$event_template_background_image}});">
        <tbody>
          <tr>
            <td>
              <div style="width:250px; margin-left:auto;margin-right: 40px;"> 
                <img src="https://www.eplame.com/dev/images/ticket/logo-new.png" width="110px" style="text-align:center; background-color: {{$logo_color}}; margin-top: 10px;">          
                <p style="margin:0; text-align: center;font-size: 14px;font-weight: 400;color: {{$event_templatefont_color}};"> SPECIAL NIGHT-{{$event_start_year}}</p>
                <h5 style="margin:0; text-align: center;margin-top:7px;font-size: 18px;font-weight: 900;color: {{$event_templatefont_color}};"> EVENT NAME</h5>
                <table style="width:100%;border-spacing: 0px;margin-bottom:10px; table-layout: fixed;padding-top:15px;"> 
                  <tr>
                    <th style="border-right: 2px solid #fff;text-align: right; padding-right: 15px;"> 
                      <h6 style="margin:0; color: {{$event_templatefont_color}};font-size: 16px;font-weight: 900; text-align:right;">1 st</h6>
                      <p style="margin:0; color: {{$event_templatefont_color}};font-size: 13px;margin-bottom: 20px;">Dj JACCULIN</p>
                    </th>
                    <td> 
                      <h6 style="margin:0; color: {{$event_templatefont_color}}; font-size: 16px;font-weight: 900;padding-left:15px;">{{$event_reg_amount}}$</h6>
                      <p style="margin:0; color: {{$event_templatefont_color}};font-size: 13px;padding-left: 15px;margin-bottom: 20px;">EVENT PRICE</p>
                    </td>  
                  </tr>
                  <tr>
                    <th style="border-right: 2px solid #fff;text-align: right; padding-right: 15px;"> 
                      <h6 style="margin:0; color: {{$event_templatefont_color}}; font-size: 16px;font-weight: 900; text-align:right;">2nd</h6>
                      <p style="margin:0; color: {{$event_templatefont_color}};font-size: 13px;">DJ MARIA</p>
                    </th>
                    <td>  
                      <p style="margin:0; color: {{$event_templatefont_color}};font-size: 13px;padding-left:15px;">DOOR OPEN</p>
                      <h6 style="margin:0; color: {{$event_templatefont_color}};padding-left:15px;"><strong>{{$event_start_time}}</strong></h6>
                    </td>  
                  </tr>
                </table>
                <p style="margin:5px 0 10px 0;text-align:center;background-color: #fff;color: {{$event_templatefont_color}};padding: 1px 5px;font-size: 13px;">{{$event_template_text}}</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
    <td style="border-radius:10px; background: #c91d8b;">
      <div class="cs-right-inner" style="transform: rotate(-90deg); text-align: center;"> 
        <h6 style="color: {{$event_templatefont_color}};margin:0;font-size: 20px; font-weight: 900;">{{$event_title}}</h6>
        <h5 style="color: {{$event_templatefont_color}};margin:0;margin-top:10px;font-size: 18px;">VIP GAT PASS</h5>
        <h5 style="color: {{$event_templatefont_color}};margin:0;margin-top:10px;font-size: 18px;">000055446</h5>
      </div>
    </td>
  </tr>
</table>

<table style="border: 1px solid #000; width: 700px; margin: 0 auto; margin: 20px auto; border-collapse: collapse;background:url({{$back_cover_background_picture}})">
      <tr>
          <td>
          <p style="text-align:center;margin-bottom: 200px;color:{{$event_back_font_colour }}">{{$template_backcover_text}}</p>
      </td>
  </tr>
</table>

</body>
</html> 