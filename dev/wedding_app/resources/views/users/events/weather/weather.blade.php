  <div id="weather_api">
         <input type="hidden" id="venue_weather_route" value="https://eplame.com/dev/venue/get-weather">
     </div>

    <div id="weather-forcast" style="display: none;">
     <div id="weatherModal"  role="dialog">
            <div class="inner-loader" id="weather-loader" style="display: none;">
                <div class="loader5"></div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Weather Report</h4>
            </div>
            <div class="weather-chart-container">
                <div class="" id="weather-content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card card-weather">
                                <div class="weather-card-body" style="background-image: url(https://eplame.com/dev/frontend/images/weather.png)">
                                    <div class="weather-date-location">
                                        <p class="text-gray"> <span class="weather-date" id="modal-localDate"></span>
                                            <span class="weather-location" id="modal-cityName"></span> <span class="weather-location" id="modal-cityCode"></span> </p>
                                    </div>
                                    <div class="weather-data d-flex">
                                        <div class="mr-auto">
                                            <div class="weather-status d-f a-i-c">
                                                <span class="weather-status-icon"><img id="modal-main-icon" src="{{ asset('/dev/frontend/DarkSky-icons/SVG/clear-day.svg') }}"></span>
                                                <h4 class="display-3" id="modal-mainTemperature"></h4>
                                            </div>
                                            <p id="tempDescription"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weather-card-body p-0">
                                    <div class="d-flex weakly-weather" id="w-hourly"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
