@extends('users.layouts.layout')
@section('content')
<link rel="stylesheet" href="{{url('js/lightbox.css')}}" />
<style type="text/css">
.seasonName {
    color: #fff !important;
}
.headline-wrap.text-center:before {
    content: "";
    position: absolute;
    height: 1px;
    background: #eda008 !important;
    width: 25%;
    left: 0;
    top: 11px;
}
.headline-wrap.text-center {
    position: relative;
    margin-bottom: 20px;
}
.headline-wrap.text-center.color-green,
.headline-wrap.text-center.color-danger {
    position: relative;
    margin-bottom: 0px;
    margin-top: 20px;
}
.headline-wrap.text-center:after {
    content: "";
    position: absolute;
    height: 1px;
    background: #eda008 !important;
    width: 25%;
    right: 0;
    top: 11px;
}
.event-planning-table-wrap .cart-totals .line {
    display: none;
}
.event-planning-table-wrap .cart-totals .headline {
    background-color: #5372aa00;
    color: #eda008;
}
.event-planning-table-wrap {
    /* background-image: linear-gradient(to right, #6389ca 0%, #34486a 100%); */
    border: 4px solid #4472c4;
    padding: 15px;
    border-radius: 4px;
    max-width: 300px;
    width: 100%;
    animation: avatar-pulse 2s infinite;
    background-image: linear-gradient(to right, #6389ca 0%, #34486a 100%);
    animation: avatar-pulse 2s infinite;
    transition: background-color 0.5s;
    transition: 0.5s ease all;
}
.event-planning-table-wrap .cart-totals .cart-table th,
.event-planning-table-wrap .cart-totals .cart-table td {
    width: auto;
    padding: 15px 10px;
    color: #fff;
    background: transparent;
    border-bottom: #ffffff29 1px solid !important;
}
.events-detail-sec .card .cls-hide-show {
    background: #35486b;
    border: none;
    color: #fff;
    margin-left: 20px;
    margin-right: 20px;
    height: 28px;
    width: 28px;
    font-size: 20px;
    padding: 0;
    outline: none;
    display: flex;
    align-items: center;
    justify-content: center;
}
.event-card-head-new {
    display: flex;
    align-items: center;
}
.cust-thanku2 {
    width: 100% !important;
    border-bottom: 1px solid #e2e2e2;
    padding: 10px;
    margin: 20px;
}
.cust-thanku2 h3 {
    margin-bottom: 0;
    padding-bottom: 0;
    border: none;
}
.events-detail-sec .card .cls-hide-show i {
    font-size: 12px;
}
.pcoded-inner-content .edit-event-btn {
    padding: 12px 20px;
    width: 100%;
    font-size: 14px;
}
table.pending-done-status td a.running-status2 {
    background: #3f4d67;
}
.zoom-btn {
    padding: 4px 15px !important;
}
</style>

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="page-header-title">
                    <h5 class="m-b-10">Detail Event</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="@if(Auth::user()->id == $user_event->user_id) {{ route('user_events') }} @else {{ route('user_co_events') }} @endif">Events</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Detail Event</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="pcoded-content p-0">
    <div class="main-header" style="background-image: url({{$user_event->banner_image !='' ? url($user_event->banner_image) : '/dev/images/event-bg.jpg'}});"  >
        <div class="main-header__intro-wrapper">
            <div class="main-header__welcome">
                <div class="main-header__welcome-title text-light">Welcome, {{ Auth::user()->first_name }}<strong></strong></div>
                <div class="main-header__welcome-subtitle text-light">How are you today?</div>
            </div>
            <div class="quickview">
                <div class="quickview__item">
                    <div class="quickview__item-total">{{ Auth::user()->UpcomingEvents->count() }}</div>
                    <div class="quickview__item-description">
                        <i class="far fa-calendar-alt"></i>
                        <span class="text-light">Events</span>
                    </div>
                </div>
                <!-- <div class="quickview__item">
<div class="quickview__item-total">64</div>
<div class="quickview__item-description">
<i class="far fa-comment"></i>
<span class="text-light">Messages</span>
</div>
</div>
<div class="quickview__item">
<div class="quickview__item-total">27°</div>
<div class="quickview__item-description">
<i class="fas fa-map-marker-alt"></i>
<span class="text-light">Austin</span>
</div>
</div> -->
            </div>
        </div>
        <div class="order-status-row">
            <article class="media order shadow delivered">
                <!--  <figure class="media-left">
         <i class="fas fa-thumbs-up"></i>
      </figure> -->
                <div class="media-content">
                    <div class="content">
                        <h3>
                            <strong>{{$user_event->title}}</strong>
                            <br>
                            <small>{{$user_event->description}}
                            </small>
                        </h3>
                    </div>
                </div>
                <div class="media-right">
                    @if($eventStatus == 'Upcoming Event')
                    <div class="card-media-body-top-icons u-float-right">
                        <div class="sm-countdown-wrap wt-countdown">
                            <ul class="count-down-timer">
                                <input type="hidden" value="{{$user_event->start_date}}" id="start_date_{{$user_event->id}}" class="timerWatch" data-days="#days_{{$user_event->id}}" data-hours="#hours_{{$user_event->id}}" data-minutes="#minutes_{{$user_event->id}}" data-seconds="#seconds_{{$user_event->id}}" />
                                <li><span id="days_{{$user_event->id}}"></span>days</li>
                                <li><span id="hours_{{$user_event->id}}"></span>Hours</li>
                                <li><span id="minutes_{{$user_event->id}}"></span>Minutes</li>
                                <li><span id="seconds_{{$user_event->id}}"></span>Seconds</li>
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="tags has-addons">
                        <span class="tag is-light">Status:</span>
                        
                    </div>
                    @endif
                </div>
            </article>
        </div>
    </div>
</div>
<section class="events-detail-sec">
    <div>
     <h3 class="text-center">Personal Information</h3>
                    <h5 class="text-center">Fill out the information below, then click Next to continue.</h5>

                    <form class="step2-form">
                      <div class="form-group">
                        <label>First Name <span>*</span></label>
                        <input type="text" name="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Last Name <span>*</span></label>
                        <input type="text" name="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Email Address <span>*</span></label>
                        <input type="text" name="" class="form-control">
                      </div>
                         <div class="form-group">
                        <label>Registration Type <span>*</span></label>
                        <ul class="radio-grp">
                          <li><input type="radio" name="event-reg_type" ><h5 id="event-reg_type"></h5></li>
                          <li><input type="radio" name="" id="event-price"></li>
                          <li><input type="radio" name="" id="event-capacity"></li> 
                        </ul>
                      </div> 
                            <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="" class="form-control">
                      </div>
                    <div class="payment-button-wrapper">
                      <a href="javascript:void(0);" class="cstm-btn solid-btn">
                        Cancel
                      </a>
                      <a href="javascript:void(0);" class="cstm-btn solid-btn">
                        Next
                      </a>
                    </div>
                    </form>
                  </div>
</section>
<!-- Modal -->
@endsection
@section('scripts')
<script src="{{url('/js/weather-custom.js')}}"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/weather-custom.js')}}"></script>
<script type="text/javascript">
$("#otherreason").hide();
$("#dis_reason").change(function() {
    var val = $("#dis_reason").val();
    if (val == "Other") {
        $("#otherreason").show();
    } else {
        $("#otherreason").hide();
    }
});
</script>
<script type="text/javascript">
CKEDITOR.replace('ideas');

// weather start
function getWeather(lat, long, time) {
    const weather_route = "{{ route('get_venue_weather') }}";
    const url = `${weather_route}?latitude=${lat}&longitude=${long}&time=${time}`;
    getSideBarWeatherData(url);
}

getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', '{{date('
    Y - m - d ', strtotime($user_event->start_date))}}');

$('#seasonName').text(getSeasonSouthernHemisphere('{{date('
    Y - m - d ', strtotime($user_event->start_date))}}'));

$('#weatherDatePicker').change(function() {
    const date = $(this).val();
    $("body").find('.custom-loading').show();
    $('#seasonName').text(getSeasonSouthernHemisphere(date));
    getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', date);
});
// weather end

function payments(paymentsData) {
    console.log('paymentsData ', paymentsData);

    let modal_data = '';
    for (var i = 0; i < paymentsData.length; i++) {

        modal_data += `<div class="order-booking-card">
   <div class="card-heading">
   <h3>Event Details</h3>
   </div>
   <div class="responsive-table">
   <table class="table table-striped order-list-table">
   <thead>
   <tr>
   <th>#</th>
   <th>Order Id</th>
   <th>Payment Type</th>
   <th>Price</th>
   </tr>
   </thead>
   <tbody>
   <tr>
   <td>1</td>
   <td>INVORD28</td>
   <td>paypal</td>
   <td>$556</td>
   </tr>
   </tbody>
   </table>
   </div>
   <div class="order-summary-wrap">
   <div class="row">
   <div class="col-lg-6">
   <div class="order-sum-card">
   <div class="billing-addres-detail">
   <h3 class="rec-heading">Billings Address</h3>
   
   <div class="billing-address-line">
   <p><span><i class="fas fa-user"></i></span>Narinder Singh</p>
   <p> <span> <i class="fas fa-map-marker-alt"></i> </span> sddsd, sdsdsd, Baretta, Punjab India wqewewe</p>
   <p> <span> <i class="fas fa-envelope"></i> </span> bajwa987647ss0491@gmail.com</p>
   <p><span><i class="fas fa-phone-volume"></i></span> 1212878777</p>
   <p></p> 
   </div>
   </div>
   </div>
   </div>
   
   <div class="col-lg-6">
   <div class="order-sum-card">
   <div class="billing-addres-detail">
   
   <div class="payment-sidebar cstm-sidebar">
   <h3 class="rec-heading">Payment Details</h3>
   <table id="payment-table" class="table payment-table">
   <tbody><tr>
   <th>
   Price
   <p>(Gold)</p>
   </th>
   <td>$1000</td>
   </tr>
   <tr>
   <th colspan="2">
   Addons 
   <ul class="mini-inn-table">
   <li><span class="labl"> Add On for two Large Portrait </span><span> $50 </span></li>     
   </ul>
   </th>
   </tr>
   <tr>
   <th>Tax</th>
   <td> $ 3</td>
   </tr>
   <tr>
   <th>Service Fee</th>
   <td>$ 3</td>
   </tr>
   <tr class="total-price-row">
   <th>Total Payable Amount</th>
   <td>$<span id="packagePrice">556</span></td>
   </tr>
   </tbody></table>
   <section class="content-header">
   <div class="row" id="suc_show" style="display: none;">
   <div class="col-md-12">
   <div class="alert alert-success">
   <strong>Success! </strong>
   <span id="res_mess"></span>
   </div>
   </div>
   </div>              
   <div class="row" id="err_show" style="display: none;">
   <div class="col-md-12">
   <div class="alert alert-danger">
   <strong>Error! </strong>
   <span id="err_mess"></span>
   </div>         
   </div>
   </div>
   </section>                
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>`;
        paymentsData[i]
    }
    $('#modal_body').html(modal_data);
}
</script>
<script>
var radius = '';
if (window.innerWidth < 767) {
    radius = '10em';
} else {
    radius = '10em'; //distance from center
}
var type = 1, //circle type - 1 whole, 0.5 half, 0.25 quarter
    start = -90, //shift start from 0
    $elements = $('.event-planning-navigation li:not(:first-child)'),
    numberOfElements = (type === 1) ? $elements.length : $elements.length - 1, //adj for even distro of elements when not full circle
    slice = 360 * type / numberOfElements;

$elements.each(function(i) {
    var $self = $(this),
        rotate = slice * i + start,
        rotateReverse = rotate * -1;

    $self.css({
        'transform': 'rotate(' + rotate + 'deg) translate(' + radius + ') rotate(' + rotateReverse + 'deg)'
    });
});





//###############################################################################################################


$("body").on('click', '.detail-btn', function(e) {
    e.preventDefault();
    var $this = $(this);
    getDetail($this);
});

//################################################################################################################


function getDetail($this) {

    var $model = $('#cat_Modal');
    var eventID = $this.attr('data-eventID');
    var categoryID = $this.attr('data-categoryID');
    var url = $this.attr('data-url');
    var title = $this.attr('data-title');
    $model.find('.modal-title').text(title);


    $.ajax({
        url: url,
        type: 'GET',
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        beforeSend: function() {
            $("body").find('.custom-loading').show();


        },
        success: function(result) {
            if (parseInt(result.status) == 1) {

                $model.find('#modal_body').html(result.htm);
                $model.modal('show');
                $("body").find('.custom-loading').hide();
            }

        },
        complete: function() {
            $("body").find('.custom-loading').hide();
        },
        error: function(jqXhr, textStatus, errorMessage) {

        }

    });
}

$('.review-submit-btn').click(function() {
    var order_id = $(this).data('event_order_id');
    var event_id = $(this).data('event_id');
    var vendor_category_id = $(this).data('vendor_cate_id');
    $('#reviewForm').find('#event-id').val(event_id);
    $('#reviewForm').find('#order-id').val(order_id);
    $('#reviewForm').find('#vendor-category-id').val(vendor_category_id);
});

$('.tip-submit-btn').click(function() {
    var vendor_id = $(this).data('vendor_id');
    var stripe_id = $(this).data('stripe');
    $('#payment-form').find('#vendor-id').val(vendor_id);
    $('#payment-form').find('#stripe').val(stripe_id);

});
$('.dispute-submit-btn').click(function() {

    var vendorid = $(this).data('vendorid');
    var user_id = $(this).data('userid');
    var business_id = $(this).data('businessid');
    var event_orderid = $(this).data('event_orderid');
    $('#raisedisputeForm').find('#vendorid').val(vendorid);
    $('#raisedisputeForm').find('#user-id').val(user_id);
    $('#raisedisputeForm').find('#business-id').val(business_id);
    $('#raisedisputeForm').find('#event-orderid').val(event_orderid);

});

$("#reviewForm").validate({
    rules: {
        rating: {
            required: true
        },
        title: {
            required: true,
            minlength: 2,
            maxlength: 30
        },
        reason: {
            required: true,
            minlength: 10,
            maxlength: 250
        }

    },
});

$('#reviewFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#reviewForm').valid()) {
        $('#reviewForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function reviewForm($this) {
    var form = $('body').find('#reviewForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    $.ajax({
        url: "<?= url(route('business.review.store')) ?>",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            $('.review-close').trigger("click");
            var thanks_url = "<?= url(route('review.thanks')) ?>";
            window.location.href = thanks_url;
        }
    });
}

$("body").on('submit', '#reviewForm', function(e) {
    e.preventDefault();
    reviewForm($(this));
});

$("#raisedisputeForm").validate({
    rules: {
        otherreason: {
            required: true
        },
        solution: {
            required: true,
            minlength: 5
        },
        reason: {
            required: true
        },
        amount: {
            required: true,
            digits: true
        },

    },
});
$('#disputeFormBtn').click(function() {
    $(this).attr('disabled', true);

    if ($('#raisedisputeForm').valid()) {

        $('#raisedisputeForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function raisedisputeForm($this) {
    var form = $('body').find('#raisedisputeForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);

    $.ajax({
        url: "<?= url(route('business.dispute.store')) ?>",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data.status == '1') {
                $('.dispute-success').css('display', 'block').fadeIn().delay(3000).fadeOut();
                window.location.href = data.redirect_links;
                return true;

            } else {
                $('.dispute-failed').css('display', 'block').fadeIn().delay(3000).fadeOut();
            }

        }
    });
}


$('#CanceEventFormBtn').click(function() {
    $(this).attr('disabled', true);

    if ($('#cancelEventForm').valid()) {

        $('#cancelEventForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function cancelEventForm($this) {
    var form = $('body').find('#cancelEventForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);

    $.ajax({
        url: "<?= url(route('user.event.eventcancel')) ?>",
        method: "POST",
        data: formData,
        //dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data.status == '1') {
                $('.event-success').css('display', 'block').fadeIn().delay(3000).fadeOut();
                window.location.href = data.redirect_links;
                return true;

            } else {
                $('.event-failed').css('display', 'block').fadeIn().delay(3000).fadeOut();
            }

        }
    });
}
$("body").on('submit', '#cancelEventForm', function(e) {
    e.preventDefault();
    cancelEventForm($(this));
});

$('.cstm-share').click(function() {
    $('.ball').css('display', 'flex');
});

$("#shareEventForm").validate({
    rules: {
        email: {
            required: true,
            minlength: 2,
            maxlength: 200
        }
    },
});

$('#shareEventFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#shareEventForm').valid()) {
        $('#shareEventForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function shareEventForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.event.share')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.share-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#shareEventForm', function(e) {
    e.preventDefault();
    shareEventForm($(this));
});

$("#select-rev-anc").click(function() {
    var id = $('#select-review').val();
    if (id > 0) {
        var test = $("a[data-match=t" + id + "]").trigger('click');
    }
});

$("#select-vendor-tip").click(function() {
    var id = $('#select-review').val();
    if (id > 0) {
        var test = $("a[data-matched=t" + id + "]").trigger('click');
    }
});

$("#testimonialForm").validate({
    rules: {
        summary: {
            required: true,
            minlength: 2,
            maxlength: 150
        }
    },
});

$('#testimonialFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#testimonialForm').valid()) {
        $('#testimonialForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function testimonialForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.testimonial.post')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.testimonial-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#testimonialForm', function(e) {
    e.preventDefault();
    testimonialForm($(this));
});

$('#thanks-note-select').select2({
    closeOnSelect: false
});

$("#thankNoteForm").validate({
    rules: {
        "guest_ids[]": {
            required: true
        },
        note: {
            maxlength: 250
        }
    },
});

$('#thankNoteFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#thankNoteForm').valid()) {
        $('#thankNoteForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function thankNoteForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.guest.thanks')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.thanks-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#thankNoteForm', function(e) {
    e.preventDefault();
    thankNoteForm($(this));
});
$("body").on('click', '#style-img1', function() {
    var src = $(this).find('img').attr('src');
    $('.big-imge').css('display', 'block');
    $('body').addClass('fixed');
    $('.big-imge').find('img').attr('src', src);
});
$('.style-close').click(function() {
    $('body').removeClass('fixed');
    $('.big-imge').css('display', 'none');
});

$(".turn").click(function() {
    setTimeout(function() {
        $('.open-book').addClass('turn-page');
    }, 1000);
    setTimeout(function() {
        $(".event-tracker").css('display', 'block');
        $(".idea-tracker").css('display', 'none');
    }, 1300);
});

$(".back-go").click(function() {
    setTimeout(function() {
        $('.open-book').removeClass('turn-page');
    }, 1300);
    setTimeout(function() {
        $(".event-tracker").css('display', 'none');
        $(".idea-tracker").css('display', 'block');
    }, 1000);
});

$("#coHostForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
            maxlength: 40,
            lettersonly: true
        },
        email: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        relation: {
            required: true,
            minlength: 2,
            maxlength: 40
        }
    },
});

$('#coHostFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#coHostForm').valid()) {
        $('#coHostForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function coHostForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('cohost_invitation')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.cohost-success').css('display', 'block');
                $('.cohost-success').find('p').text('Invitation has been sent successfully.');
                location.reload();
            } else if (data == 102) {
                $('.custom-loading').css('display', 'none');
                $('.cohost-success').css('display', 'block');
                $('.cohost-success').find('p').text('You have already sent an invitation to this email.');
                $('#coHostFormBtn').attr('disabled', false);
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#coHostForm', function(e) {
    e.preventDefault();
    coHostForm($(this));
});

$('#coHostForm').click(function() {
    $(this).find('.cohost-success').css('display', 'none');
});

$('#thanks-template').change(function() {
    var val = $(this).val();
    $('#thank-note-area').val(val);
});

// tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
// tooltip end
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]',
                'input[type=password]',
                'input[type=text]',
                'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('.inp-error'),
            valid = true;
        $errorMessage.addClass('d-none');
        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {



            e.preventDefault();
            Stripe.setPublishableKey("");
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.stripe-error').text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.nav-toggle').click(function() {
        //get collapse content selector
        var collapse_content_selector = $(this).attr('href');

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function() {
            if ($(this).css('display') == 'none') {
                //change the button label to be 'Show'
                toggle_switch.html('+');
            } else {
                //change the button label to be 'Hide'
                toggle_switch.html('<i class="fas fa-minus"></i>');
            }
        });
    });

});
</script>
@endsection