<style type="text/css">
  select#select_weather_unit {
      width: 90%;
      background: #ffffff;
      padding: 7px;
      border-radius: 30px;
      outline: none;
      margin: 10px auto;
      text-align: center;
      justify-content: center;
      display: flex;
  }
</style>
<section class="services-tab-sec">
   <div class="container">
      <div class="sec-card" data-step="3" data-intro="You can get the list of vendors by specifying your the search criterion.">
         <div class="tab-wrap">  
            <div class="form-tab-slider owl-carousel owl-theme">
               <div class="item wow bounceInDown">
                  <div class="tab-button">
                     <div class="tab-item">
                        <a href="javascript:void();" data-tag="twenty-three" class="activelink getCategory" data-id="0"
                           data-url="{{ url(route('get_homepage_formdata',0)) }}">
                           <span class="service-icon">
                           <img class="category_icon" src="{{url('frontend/images/all.png')}}" />
                           </span>
                           <h3>all</h3>
                        </a>
                     </div>
                  </div>
               </div>

               @foreach($categories as $key => $category)
               <div class="item wow bounceInDown" data-wow-delay="{{ $key*500+500}}ms">
                  <div class="tab-button">
                     <div class="tab-item">
                        <a href="javascript:void();" data-tag="twenty-three" class="getCategory" data-id="{{$category->id}}"
                           data-url="{{ url(route('get_homepage_formdata',$category->id)) }}">
                           <span class="service-icon no-border">
                           <img class="category--img" src="{{url($category->image)}}"/>
                           </span>
                           <h3>{{ $category->label }}</h3>
                        </a>
                     </div>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
         <div class="tab-content" data-aos="fade-right" data-aos-duration="3000">
            <div class="tab-data " id="twenty-three">
               <form id="SearchForm" class="services-form" action="{{url(route('home_vendor_listing_page'))}}" >
                  <input type="hidden" name="category_id" id="vendor_category_id" value="">
                 <!--  <input type="hidden" name="category_id" value="0"> -->
                  <div class="row">
                  	 <div class="col-lg-4">
                        <div class="form-group">
                           <input type="text" class="form-control start_date" placeholder="Start Date" name="start_date" id="start_date1" >
                           <span class="input-icon"><i class="far fa-calendar"></i></span>
                        </div>
                     </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                           <input type="text"  class="form-control" placeholder="End Date" name="end_date" id="end_date2">
                           <span class="input-icon"><i class="far fa-calendar"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4 addressColumn">
                        <div class="form-group">
                           <input type="text"  class="form-control" placeholder="Location" id="address" name="location" autocomplete="off">

                           <input  type="hidden" name="latitude1" id="latitude" value="">
                           <input  type="hidden" name="longitude1" id="longitude" value="">

                           <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4 eventColumn">
                        <div class="form-group">
                           <select class="form-control select2 eventType" name="event_type[]" data-placeholder="Event Type" id="EventSelect">
                              <option></option>
                           </select>
                           <span class="input-icon"><i class="fas fa-glass-cheers"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4 vendorColumn">
                        <div class="form-group">
                            
                           <select class="form-control select2 SuggestedVendors" id="SuggestedVendors" multiple="multiple" name="vendors[]" data-placeholder="Select Vendors">
                              <option></option>
                           </select>
                           <span class="input-icon"><i class="fas fa-user"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                             <select class="form-control select2 amenitiesAndGames" name="amenities[]" id="amenities" multiple="multiple" data-placeholder="Amenities">
                              <option></option>
                           </select>
                           <span class="input-icon"><i class="fas fa-concierge-bell"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                             <select class="form-control select2 games" name="games[]" id="games"  multiple="multiple" data-placeholder="Games">
                              <option></option>
                           </select>
                           <span class="input-icon"><i class="fas fa-concierge-bell"></i></span>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <input type="text"  class="form-control" placeholder="Number of Guest" name="guest_capacity">
                           <span class="input-icon"><i class="fas fa-users"></i></span>
                        </div>
                     </div>
                     
                      <div class="col-lg-4">
                        <div class="form-group partly-cloudy-hidden" style="margin-bottom: 0!important;">

                        <div class="weather-mini-card weather-units" id="infomsg" style="display:none;">
                          <h6 style="font-size: 15px;font-weight: 600;text-align: center;">Weather Report for event date. Click for more information.</h6>
                          <div class="weather-temperature-units">
                             <select id="select_weather_unit">
                                 <option value=1>celcius</option>
                                 <option value=2>Farenheit</option>
                             </select>
                           </div>
                           <a data-toggle="modal" data-target="#weatherModal" id="open_weather_modal" href="javascript:void(0);">
                          <div class="weather-info weather-mini-card-info" style="background-image: url(https://eplame.com/dev/frontend/images/weather.png)">
                            <div class="weather-info-wrapper">
                              <div class="info-date">
                                <h5><span class="weather-city" id="summary"></span> <spam id="summary"></spam></h5>
                              </div>
                              
                              <div class="info-weather">
                                <div class="weather-wrapper">
                                  <span class="weather-temperature" id="temperature"></span>
                                  <div class="weather-sunny"><img id="main-icons-search" src="https://eplame.com/dev/frontend/DarkSky-icons/SVG/clear-day.svg"></div>
                                </div>        
                                
                                
                              </div>
                            </div>
                          </div>
                          </a>  
                        </div>
                      </div>                        
                     </div>
                    
                  </div>
                  <div class="btn-wrap text-center">
                    <!--  <a href="" class="cstm-btn solid-btn">Search <span><i class="fas fa-search"></i></span></a> -->

                     <button id="searchFormBtn" type="submit" class="cstm-btn solid-btn">Search <span><i class="fas fa-search"></i></span></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#start_date1" ).datepicker({
      minDate: 0,
      dateFormat: 'yy-mm-dd',
      onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#end_date2").datepicker("option", "minDate", dt);
        },
    });
    $( "#end_date2" ).datepicker({
       dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#start_date1").datepicker("option", "maxDate", dt);
        }
    });
  } );
  </script>
  <script type="text/javascript">
$(document).ready(function() {
  $('#address').focusout(function() {
  	 setTimeout(function() { 
  		   setWeather();
    	  }, 600);
     });
  
  $("#select_weather_unit").on("change",(e)=>{
    $("#temperature").fadeOut();
    setWeather(e.target.value);
  })
});

function setWeather(unit=1)
{  var latitude = $("#latitude").val();
          var longitude = $("#longitude").val();
          var start_date1 = $("#start_date1").val();
         
            $.ajax({
            method: 'post',
            url : "<?= url(route('get_weather')) ?>",
            data:  { latitude: latitude,longitude: longitude,start_date:start_date1 },
            headers: {
             'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success: function(response) {
             $('#infomsg').show();
             $("#result").html('<input type="hidden" value="'+response.url+'" id="venue_weather_route"/>');
             $("#main-icons-search").attr('src', `{{url('/')}}/frontend/DarkSky-icons/SVG/${response.weather_json.daily.icon}.svg`);
              $("#summary").html(response.weather_json.currently.summary).show();
              if(unit==1){

                $("#temperature").html(toCelcius(response.weather_json.currently.temperature)+'°C').fadeIn();
              }else{
                 $("#temperature").html(toFerenheit(response.weather_json.currently.temperature) + '°F').fadeIn();
              }
                             $('#infomsg2').show();
                $("#main-icon").attr('src', `/frontend/DarkSky-icons/SVG/${response.weather_json.currently.icon}.svg`);
               
            }
          });

  }

  </script>