<div class="package-card" id="package-sec">
   <div class="container lr-container">
      <div class="pannel-card1">
         <div class="card-heading">
            <h3>Related Packages</h3>
         </div>
         <div class="packages-content">
            <div class="packages-wrap">
               <div class="row">

              
        @foreach($packages as $key => $package)
                             <div class="col-lg-4" id="package_clone_{{$package->id}}">
                                   <div class="package-card">
                                    <div class="inn-card">
                                      
                                      <div class="title">    	
                                        <div class="icon">
                                          <i class="fas fa-hand-holding-usd"></i>
                                        </div>
                                        <span class="pkg-amount">{{custom_format($package->price,2)}}</span>
                                       <!--  <p class="priceType">{{$package->price_type == "per_person" ? "Per Person" : "Fixed Price"}}</p> -->
                                      </div>

                                      <div class="content">
                                        <div class="inn-card-body">
                                          <h3 class="price-table-heading">{{$package->title}}</h3>
                                           <div class="pricing-category">
                                               <div class="pkg-summary">
                                                  <label>Decription</label> 
                                                    <div class="card-text">
                                                      <?= $package->description ?>      
                                                     </div>
                                               </div>

                                               @if(!empty($package->menus))
                                               <div class="pkg-summary">
                                                  <label>Menus</label> 
                                                    <div class="card-text">
                                                      {!! $package->menus !!}      
                                                     </div>
                                               </div>
                                               @endif

                                           </div>

                                        <!-- rk package details start -->
                                           <div class="pricing-category border-tp-bt">
                                              <div class="row">
                                                 <div class="col-md-6 border-rt">
                                                       <label for="no_of_hours">Amenities</label>
                                                       <ul class="pkg-listing-grp">  
                                                            <?php $amenities = getPackageAmenities($package); ?>
                                                          @foreach($amenities as $amenity)
                                                            <li class="pkg-listing">{{$amenity->amenity->name}}</li>
                                                          @endforeach
                                                       </ul>       
                                                  </div>
                                                  <div class="col-md-6">
                                                         <label for="no_of_hours">Events</label>
                                                          <ul class="pkg-listing-grp">
                                                            <?php $packageEvents = getPackageEvents($package); ?>
                                                               @foreach($packageEvents as $amenity)
                                                                    <li class="pkg-listing">{{$amenity->event->name}}</li>
                                                                @endforeach
                                                          </ul>
                                                 </div>
                                                 <div class="col-md-6">
                                                         <label for="no_of_hours">Games</label>
                                                           <ul class="pkg-listing-grp">  
                                                            <?php $getPackageGames = getPackageGames($package); ?>
                                                            @foreach($getPackageGames as $game)
                                                               <li class="pkg-listing">{{$game->amenity->name}}</li>
                                                            @endforeach
                                                           </ul>
                                                 </div>
                                              </div>
                                            </div>

                                            @if(count($package->package_addons))
                                        <div class="pricing-category">
                                              <label for="add-ons">Add Ons</label>

                                              @foreach($package->package_addons as $package_addon)
                                                <div class="vendor-category blue-bg">
                                                  <div class="category-checkboxes category-title">
                                                    {{$package_addon->key}} 
                                                    ${{$package_addon->key_value}}
                                                  </div>
                                                </div>
                                              @endforeach
                                        </div>
                                        @endif
                                        
                                  <table class="pricing-inn-table">
                                    <tbody>
                                          <tr>
                                           <th>Service Timing</th>
                                          <td>{{$package->no_of_hours}} {{$package->no_of_hours > 1 ? 'Hours' : 'Hour'}}</td>
                                        </tr>
                                        <tr>
                                           <th>Package For (In Days)</th>
                                           <td>{{$package->no_of_days}} {{$package->no_of_days > 1 ? 'Days' : 'Day'}}</td>
                                        </tr>
                                         
                                        <tr>
                                           <th>Number of Person</th>
                                           <td>({{$package->min_person}} - {{$package->max_person}}) Persons</td>
                                        </tr>
                                      
                                     @if(!empty($vacations))
                                     @foreach($vacations as $vacation) 
                                     @php $todayDate = date("Y-m-d");
                                      
                                      if($todayDate <= $vacation->vacation_to ){ @endphp
                                        <tr >
                                            <th colspan="2" class="vendor">Vendor on vacation between {{$vacation->vacation_from}} to {{$vacation->vacation_to}} </th>
                                           
                                        </tr>
                                       
                                        @php } @endphp
                                       @endforeach 
                                      @endif 
                                    </tbody>
                                  </table>
                                  </div>

                                 @if(empty($reviewing))
                                        <div class="btn-area inn-card-footer" id="buy-content">
                                          <!--  <a href="{{url(route('payWithPackage',$package->slug))}}" class="cstm-btn">Buy</a> -->
                                          <a href="javascript:void(0);" 
                                             class="cstm-btn cartModal" 
                                             data-id="{{$package->id}}"
                                             data-title="{{$package->title}}"
                                             data-price="${{$package->price}}"
                                             data-dealId="{{!empty($deal) ? $deal->id : 0}}"
                                             data-description="{{$package->description}}"
                                             data-capacity="({{$package->min_person}} - {{$package->max_person}}) Persons"
                                             data-action="{{url(route('cart.packageCheck'))}}"
                                             >Buy</a>
                                          
                                         @if(!empty($vendor) && count($vendor->VendorPackage) >= 2)
                                           <div class="custom-control custom-checkbox">
                                               <input 
                                               type="checkbox" 
                                               value="{{$package->id}}"
                                               data-package="{{$package}}"
                                               class="custom-control-input comparePackages"
                                               id="customCheck_{{$package->id}}"
                                               >
                                                <label class="custom-control-label" for="customCheck_{{$package->id}}">Compare</label>
                                          </div>

                                        @endif
                                             
                                        </div>
                                  @endif
                                       
                                 </div>

                              </div>
                            </div> 
                          </div>

@endforeach


<input type="hidden" id="getPackageBox" value="{{url(route('ajax.compare.package'))}}">
<input type="hidden" id="getCompareInformation" value="{{url(route('ajax.compare.package'))}}">

               </div>
            </div>
         </div>
      </div>
   </div>
</div>



<div class="container lr-container" id="com_pack_headings"></div>
 <style>
 .vendor {
    background: #721c24;
    text-align: center;
    color: #fff;
</style>























