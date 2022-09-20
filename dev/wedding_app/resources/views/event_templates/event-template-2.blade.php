<?php 
    // echo '<pre>';
    // print_r($event_data);
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
    <table class="ticket-card-2" style="width: 746px; margin: 0 auto; border-collapse: collapse;">
        <tr>
            <td style="width: 65%;">                        
            <table style="border-radius: 0 10px 10px 0;width:100%;background:url({{$event_template_background_image}});">
                <tbody>
                    <tr>
                        <td>
                            <div style="margin-left:auto;width: 230px;"> 
                                <img src="https://www.eplame.com/dev/images/ticket/logo-new.png" width="110px" style="text-align:center; background-color: {{$logo_color}};margin-top: 10px;">            
                                <p style="margin:0; font-size: 19px;font-weight: 800;color: {{$event_templatefont_color}};"> Lorem ipsum </p>
                                <h5 style="margin:0; margin-top:7px;font-size: 19px; font-weight: 800;color: {{$event_templatefont_color}};"> SPORT EVENT</h5>
                                <p style="margin:5px 0 10px;color: {{$event_templatefont_color}};font-size: 10px;"> {{$event_template_text}} </p>
                                <table style="width:100%;border-spacing: 5px;margin-bottom:10px; table-layout: fixed;"> 
                                    <tr >
                                        <td style="text-align:center; text-align: left; border: 2px solid #fff; padding: 5px;"> 
                                            <table>
                                            <tr> 
                                                <td> 
                                                    <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                                </td>
                                                <td> 
                                                    <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;"> 01</p>
                                                </td>
                                            </tr>    
                                            </table>
                                            
                                        </td>
                                        <td style="text-align:center; text-align: left; border: 2px solid #fff; padding: 5px;">
                                        <table>
                                            <tr> 
                                                <td> 
                                                    <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                                </td>
                                                <td> 
                                                    <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;"> 02</p>
                                                </td>
                                            </tr>    
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center; text-align: left; border: 2px solid #fff; padding: 5px;">
                                        <table>
                                            <tr> 
                                                <td> 
                                                    <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                                </td>
                                                <td> 
                                                    <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;"> 03</p>
                                                </td>
                                            </tr>    
                                            </table>                                           
                                        </td>
                                        <td style="text-align:center; text-align: left; border: 2px solid #fff; padding: 5px;">                          
                                            <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;"> VIP</p>
                                        </td>
                                    </tr>
                                </table>
                                <p style="margin:5px 0 10px 0;color: {{$event_templatefont_color}};">lorem:<strong> 35 </strong></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>          
            
            </td>
            <td style="background-color:#4c015e;border-radius:10px; border-left: 1px dashed #fff;vertical-align:top;">                 
                <div style="margin-top: 20px;">    
                    <p style="margin:0; font-size: 13px;font-weight: bold;color: {{$event_templatefont_color}};text-align:center;"> Lorem ipsum </p>
                    <h5 style="margin:0; margin-top:7px;font-size: 17px; font-weight: bold;color: {{$event_templatefont_color}};text-align:center;"> SPORT EVENT</h5>
                    <p style="margin:0 0 10px 0;color: {{$event_templatefont_color}};text-align:center;font-size: 10px;"> lorem ipsum dolor sit amet </p>
                    <table style="width:100%;"> 
                        <tr>
                            <td style="text-align:center;"> 
                                <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;margin-bottom:10px"> 01</p>
                            </td>
                            <td style="text-align:center;">
                                <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;margin-bottom:10px"> 02</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <p style="margin:0;color: {{$event_templatefont_color}}; font-size: 10px; margin-bottom:5px">Row </p>
                                <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;margin-bottom:10px"> 03</p>
                            </td>
                            <td style="text-align:center;">                          
                                <p style="margin:0;font-size: 22px;color: {{$event_templatefont_color}};font-weight: 800;margin-bottom:10px"> VIP</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid #000; width: 746px; margin: 0 auto; margin: 20px auto; border-collapse: collapse;background:url({{$back_cover_background_picture}});background-size: cover;">
            <tr>
                <td>
                <p style="text-align:center;margin-bottom: 246px;color:{{$event_back_font_colour}}">{{$template_backcover_text}}</p>
            </td>
        </tr>
    </table>
</body>
</html>  