<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, maximum-scale=1,initial-scale=1.0">  

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--     <meta http-equiv=“Content-Security-Policy” content=“default-src ‘self’ gap://ready file://* *; style-src ‘self’ ‘unsafe-inline’; script-src ‘self’ ‘unsafe-inline’ ‘unsafe-eval’”/> -->

    <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="{{url('/arrowchat/external.php?type=css')}}" charset="utf-8" />
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.0/flexslider.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.css">

    <!-- materialdesignicons css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
     <!-- ============ -->

    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

 @yield('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/responsive.css')}}">
     <link rel="stylesheet" href="{{url('/css/chat.css')}}">
     <link rel="stylesheet" href="{{url('/css/common-style.css')}}">
    <link rel="stylesheet" href="{{url('/css/common-responsive.css')}}">
    
    

<style type="text/css">
    .custom-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #11111169;
        z-index: 999999999999999;
        display: block;
    }
    #addNewTaskModal {
    z-index: 9;
   }
</style>

@yield('head')
 <script type="text/javascript">

  let $upcommingTimerArray = [];

 </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-188574033-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-188574033-1');
</script>

</head>
<body data-url="{{url('/')}}" class="{{\Request::route()->getName() === 'vendor_detail_page' || \Request::route()->getName() === 'myBusinessView' ? 'gray-bg' : ''}}">
	
<div class="custom-loading"><div class="loader5"></div></div>



@if(\Request::route()->getName() =="homepage" || \Request::route()->getName() =="homepage2")
@include('home.includes.header')
@else
@include('home.includes.inner_header')

@endif

@yield('content')

@include('home.includes.footer')
  <!-- Scripting starts here -->
<!--     <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> -->
   
    <script type="text/javascript" src="{{url('/arrowchat/includes/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{url('/arrowchat/includes/js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{url('/arrowchat/external.php?type=djs')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{url('/arrowchat/external.php?type=js')}}" charset="utf-8"></script>
   
   
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.12/wow.min.js"></script>
    <script src="{{url('/frontend/js/animation.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>
    <script src="{{url('/frontend/js/ResizeSensor.js')}}"></script>
    <script src="{{url('/frontend/js/sticky-sidebar.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{url('/frontend/js/bootstrap-datetimepicker.min.js')}}"></script>
 <!--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.0/jquery.flexslider.min.js"></script> -->
     <script type="text/javascript" src="{{url('frontend/js/flexslider.js')}}"></script>
    <script type="text/javascript" src="{{url('/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="https://yauzer.com/js/validate.min.js"></script>
    <script src="{{url('/admin-assets/js/validations/customValidation.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="{{url('/frontend/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="{{url('js/intro.js')}}"></script>
     
    <script> 

        new WOW().init();

        AOS.init({
          disable: function() {
            var maxWidth = 1025;
            return window.innerWidth < maxWidth;
          }
        });

    </script>

    <script>

   jQuery("body").find('.custom-loading').show();
 
        //Photos flex slider 
$(window).load(function() {

      setTimeout(() => {
        jQuery("body").find('.custom-loading').hide();
           
      }, 3000)
  // The slider being synced must be initialized first
  $('#Photo-carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 165,
    itemMargin: 5,
    maxItems: 6,
    asNavFor: '#Photo-slider'
  });
 
  $('#Photo-slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#Photo-carousel"
  });


  // The slider being synced must be initialized first
  $('#Video-carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 5,
    asNavFor: '#Video-slider'
  });
 
  $('#Video-slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#Video-carousel"
  });

});

 
$(function () {
    $('#datetimepicker1').datetimepicker();
    $('#weatherDatePicker').datetimepicker({ format: 'YYYY-MM-DD' });
});

$('.show-icons').click(function(){
  $('.big-nav').addClass('show-big-nav');
   //$('body').addClass('body-fixed');
});

$('.go-back').click(function(){
  $('.big-nav').removeClass('show-big-nav');
  //$('body').removeClass('body-fixed');

});

const chat_btn = $("#chat-bot .icon");
const chat_box = $("#chat-bot .messenger");

chat_btn.click(() => {
  chat_btn.toggleClass("expanded");
  setTimeout(() => {
    chat_box.toggleClass("expanded");
  }, 100);
});


// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();   
// });

$("#testimonialForm").validate({
  rules: {
    summary:{
      required: true,
      minlength: 2,
      maxlength: 150
    }
  },
});

$('#testimonialFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#testimonialForm').valid()){
        $('#testimonialForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function testimonialForm($this) {
   $('.custom-loading').css('display', 'block');
  $.ajax({
      url : "<?= url(route('user.testimonial.post')) ?>",
      data : $this.serialize(),
      type: 'POST',  // http method
      dataTYPE:'JSON',
      headers: {
       'X-CSRF-TOKEN': $('input[name=_token]').val()
      },
      success: function (data) {
        if(data == 101){
          $('.custom-loading').css('display', 'none');
          $('.testimonial-success').css('display', 'block');
          location.reload();
        }else{
          alert('something went wrong');
        }
      }
  });
}

$("body").on('submit','#testimonialForm',function(e){
    e.preventDefault();
    testimonialForm($(this));
});

$("#bugForm").validate({
  rules: {
    summary:{
      required: true,
      minlength: 2,
      maxlength: 250
    },
    name:{
      required: true,
      minlength: 2,
      maxlength: 50
    },
    email:{
      email: true,
      required: true,
      minlength: 2,
      maxlength: 60
    }
  },
});

$('#bugFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#bugForm').valid()){
        $('#bugForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function bugForm($this) {
  var form = $('#bugForm')[0];
  var formData = new FormData(form);
   $('.custom-loading').css('display', 'block');
   $.ajax({
            url : "<?= url(route('bug.report')) ?>",
            method:"POST",
           data:formData,
           dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           
           beforeSend: function() {
            

            },
            xhr: function () {
              var xhr = new window.XMLHttpRequest();
              return xhr;
            },
            success:function(data)
            {
              if(data == 101){
                $('.custom-loading').css('display', 'none');
                $('.bug-success').css('display', 'block');
                location.reload();
              }else{
                alert('something went wrong');
              }
            }
        });
}

$("body").on('submit','#bugForm',function(e){
    e.preventDefault();
    bugForm($(this));
});

/*$("#feedbackForm").validate({
  rules: {
    summary:{
      required: true,
      minlength: 2,
      maxlength: 250
    },
    name:{
      required: true,
      minlength: 2,
      maxlength: 50
    },
    email:{
      email: true,
      required: true,
      minlength: 2,
      maxlength: 60
    }
  },
});

$('#feedbackFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#feedbackForm').valid()){
        $('#feedbackForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function feedbackForm($this) {
   $('.custom-loading').css('display', 'block');
  $.ajax({
      url : "<?= url(route('feedback.post')) ?>",
      data : $this.serialize(),
      type: 'POST',  // http method
      dataTYPE:'JSON',
      headers: {
       'X-CSRF-TOKEN': $('input[name=_token]').val()
      },
      success: function (data) {
        if(data == 101){
          $('.custom-loading').css('display', 'none');
          $('.feedback-success').css('display', 'block');
          location.reload();
        }else{
          alert('something went wrong');
        }
      }
  });
}

$("body").on('submit','#feedbackForm',function(e){
    e.preventDefault();
    feedbackForm($(this));
});*/


$("#requestForm").validate({
  rules: {
    requirements:{
      required: true,
      minlength: 2,
      maxlength: 400
    },
    comp_summary:{
      maxlength: 400
    },
    solution:{
      maxlength: 400
    },
    name:{
      required: true,
      minlength: 2,
      maxlength: 50
    },
    email:{
      email: true,
      required: true,
      minlength: 2,
      maxlength: 60
    }
  },
});

$('#requestFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#requestForm').valid()){
        $('#requestForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function requestForm($this) {
   $('.custom-loading').css('display', 'block');
  $.ajax({
      url : "<?= url(route('feature.request')) ?>",
      data : $this.serialize(),
      type: 'POST',  // http method
      dataTYPE:'JSON',
      headers: {
       'X-CSRF-TOKEN': $('input[name=_token]').val()
      },
      success: function (data) {
        if(data == 101){
          $('.custom-loading').css('display', 'none');
          $('.feature-success').css('display', 'block');
          location.reload();
        }else{
          alert('something went wrong');
        }
      }
  });
}

$("body").on('submit','#requestForm',function(e){
    e.preventDefault();
    requestForm($(this));
});




    </script>


@yield('scripts')
<script type="text/javascript">
$(document).mouseup(function(element) 
{
 outsideclickCloseSection(element,"#main-navigation #menus-list a",ObjectConstructor('#main-navigation','active'),ObjectConstructor('.fixed-body','fixed-body'));

 outsideclickCloseSection(element,"#chat-bot",ObjectConstructor('#chat-bot .icon','expanded'),ObjectConstructor('#chat-bot .messenger.br10','expanded'));

 outsideclickCloseSection(element,"#tool-nav #menus-list a",ObjectConstructor('#tool-nav','active'),ObjectConstructor('.fixed-body','fixed-body'));

 outsideclickCloseSection(element,"#UserUpcmStatus",ObjectConstructor('.user-status-content','show-sidebar'));

});

function outsideclickCloseSection(e,main_id,...objectarray){
  var container = $(`${main_id}`);
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
         objectarray.forEach((e)=>{
          $(`${e.selector}`).removeClass(`${e.remove}`);
         })
    }
}

function ObjectConstructor(where,which){
     this.where=where;
     this.which=which;
     return {selector:where,remove:which} ;
}
</script>
</body>

</html>