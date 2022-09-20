<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eplame User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Free Datta Able Admin Template come up with latest Bootstrap 4 framework with basic components, form elements and lots of pre-made layout options" />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
    <meta name="author" content="CodedThemes"/>

    <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="/dev/arrowchat/external.php?type=css" charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{url('/admin-assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{url('/admin-assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{url('/admin-assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" type="text/css" href="{{url('/css/nestable.css')}}"> 
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- <link href="/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/bootstrap-fileinput-master/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('/AdminFILE/dist/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{url('/admin-assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('/css/user.css')}}">
    <link rel="stylesheet" href="{{url('/css/user_style.css')}}">
    <link rel="stylesheet" href="{{url('/css/chat.css')}}">
    <link rel="stylesheet" href="{{url('/css/common-style.css')}}">
    <link rel="stylesheet" href="{{url('/css/common-responsive.css')}}">

    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('clockface/css/clockface.css')}}"> 
</head>

<body>
<div class="custom-loading"><div class="loader5"></div></div>
@include('users.includes.sidebar')
@include('users.includes.header')


<div class="pcoded-main-container">
  <div class="pcoded-wrapper">
    <div class="pcoded-content">
    <div class="pcoded-inner-content">
    <!-- Main Content -->
    @yield('content')
  </div>
</div>
  </div>
</div>
<a href="javascript:void(0);" class="scrollTop" style="opacity: 1;"><i class="fas fa-arrow-alt-circle-up"></i></a>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

<script type="text/javascript" src="/dev/arrowchat/includes/js/jquery.js"></script>
<script type="text/javascript" src="/dev/arrowchat/includes/js/jquery-ui.js"></script>
<script src="{{url('/AdminFILE/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{url('/bootstrap-fileinput-master/js/fileinput.js')}}" type="text/javascript"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ getAllValueWithMeta('google_api_key', 'global-settings') }}&libraries=places"></script>
<script src="{{url('/admin-assets/js/vendor-all.min.js')}}"></script>
<script src="{{url('/admin-assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{url('/admin-assets/js/pcoded.min.js')}}"></script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<!-- <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script> -->
<script src="{{url('/admin-assets/js/validations/customValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.12/wow.min.js"></script>
<script type="text/javascript">
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    AOS.init();

    new WOW().init();
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#action_menu_btn').click(function(){
    $('.action_menu').toggle();
  });
});

function deleteItem(item) {
  const url = $(item).data('delurl');
  if (confirm("Are you sure you want to delete it!")) {
    window.location.href = url;
  }
}

$(document).ready(function() {
  /******************************
      BOTTOM SCROLL TOP BUTTON
   ******************************/

  // declare variable
  var scrollTop = $(".scrollTop");

  $(window).scroll(function() {
    // declare variable
    var topPos = $(this).scrollTop();

    // if user scrolls down - show scroll to top button
    if (topPos > 100) {
      $(scrollTop).css("opacity", "1");

    } else {
      $(scrollTop).css("opacity", "0");
    }

  }); // scroll END

  //Click event to scroll to top
  $(scrollTop).click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;

  }); // click() scroll top EMD
});

</script>




@yield('scripts')

<script type="text/javascript" src="/dev/arrowchat/external.php?type=djs" charset="utf-8"></script>
<script type="text/javascript" src="/dev/arrowchat/external.php?type=js" charset="utf-8"></script>

</body>
</html>
