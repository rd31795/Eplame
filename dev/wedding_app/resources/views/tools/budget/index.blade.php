@extends('layouts.home')
@section('title') Eplame|Budget @endsection
@section('description') Eplame|Budget @endsection
@section('keywords') Eplame|Budget @endsection

@section('content')
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
        <div class="container">
            <div class="banner-content event-top">
                <h1>{{$budget_title}}</h1>
                 <p>{{$budget_tagline}}</p>
            </div>
        </div>
        
    </section>


    @include('tools.includes.navbar')
    <!--Banner section Ends here-->

    @if(Auth::user()->id == $user_event->user_id || checkPermission('budget_management', $user_event->id) == 1)
    <!--Tabs Section starts here-->
    <section class="services-tab-sec">

        <div class="container">
            <div class="sec-card">
                <div class="tab-wrap">
                  



              <!--  Category Management block -->
              <div class="checklist-wrap bugdet-page">
                            <span class="aside-toggle">
                                <i class="fa fa-bars"></i>
                                <span class="cross-class">
                                    <i class="fas fa-times" style="display: none;"></i>
                                </span>
                            </span>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 eventside-bar">
                                    <aside>
                                        <div class="inner-padding">
                                            <div class="wrap1">
                                                <a href="javascirpt:void(0);" class="task-btn" data-toggle="modal" data-target="#AddCategory">
                                                    New Category<span><i class="fas fa-plus"></i></span>
                                                </a>
                                            </div>
                                            <div class="wrap1 selectedCheck">
                                                <ul>
                                                    @foreach($cate as $cats)
                                                    <li>
                                                        <a href="javascript:void(0);" class="getcat" data-id="{{$cats->id}}">
                                                            {{$cats->catagory_label}} 
                                                            <span>
                                                                @if($cats->final_budget == 0)
                                                                    ${{$cats->estimated_budget}}
                                                                @else
                                                                    ${{$cats->final_budget}}
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="eventlist-text">
                                        <div class="event-task">
                                            <ul class="cst-nav-tabs">
                                                <li class="clickme"><a href="{{route('users.budget', $user_event->slug)}}" data-tag="two" class="activelink">Budget</a></li>
                                                <li class="clickme"><a href="{{route('users.eventPayment', $user_event->slug)}}" data-tag="three">Payment</a></li>
                                            </ul>
                                            <div class="icons">
                                                
                                                    <a href="{{route('user.budget.getPDFBudget', $user_event->slug)}}" title="Download Pdf">
                                                        <i class="fas fa-file-download"></i>
                                                    </a>
                                                    
                                                    <a target="_blank" href="javascript:void(0)" data-toggle="modal" data-target="#calculator_modal" title="Calculator">
                                                       <i class="fas fa-calculator"></i>
                                                    </a>

                                                    <a href="{{route('user.budget.printFunction', $user_event->slug)}}" title="Print">
                                                        <i class="fas fa-print"></i>
                                                    </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="budget-wrap">
                                        <div class="list active" id="two">
                                            <div class="budget-content">
                                                <div class="cst-cost-card">
                                                <h3>Budget</h3>
                                             <div class="row">
                                                <div class="col-lg-6"> 
                                                <div class="budget_card blue text-left">
                                                   <div class="title">Estimated Cost</div><span class="glyphicon">
                                                <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                   <div class="value est-cst"><i class="fas fa-dollar-sign"></i> @if($user_event->estimated_budget != 0)
                                                            {{$user_event->estimated_budget}}
                                                        @else
                                                            {{$user_event->event_budget}}
                                                        @endif</div>
                                                   <div class="stat"><a href="javascript:void(0);" class="edit-btn edti-budget-btn"><i class="fas fa-edit"></i> Edit</a></div>
                                                 </div>           
                                                <!-- <div class="save-box wow bounceInRight" data-wow-delay="50ms">                                           
                                                    <span class="dollar">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <div class="est-cost_content">
                                                    <h4>Estimated Cost</h4>
                                                    <p class='est-cst'>@if($user_event->estimated_budget != 0)
                                                            {{$user_event->estimated_budget}}
                                                        @else
                                                            {{$user_event->event_budget}}
                                                        @endif</p>
                                                    <a href="javascript:void(0);" class="edti-budget-btn mt-3"><i class="fas fa-edit"></i></a>
                                                     </div>
                                                </div> -->
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="budget_card orange text-left">
                                                   <div class="title">Final Cost</div><span class="glyphicon">
                                                <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                   <div class="value"><i class="fas fa-dollar-sign"></i> {{$final}}</div>
                                                   <div class="stat"><span>Paid: ${{$paid}}</span> <span>Pending ${{$final - $paid}}</span></div>
                                                 </div>
                                                <!-- <div class="save-box wow bounceInRight" data-wow-delay="80ms">
                        
                                                    <span class="dollar">
                                                        <i class="fas fa-dollar-sign"></i>                       
                                                    </span>
                                                    <div class="est-cost_content final-cost est-cst">
                                                        <h4>Final Cost</h4>
                                                    <p>
                                                        {{$final}}
                                                    </p>
                                                    <h6 class="mt-2">Paid: <span class="mr-3">$ {{$paid}}</span> Pending: <span>$ {{$final - $paid}}</span></h6>
                                                </div>
                                                </div> -->
                                            </div>
                                           
                                                </div>
                                            </div>

                                                <!-- <a href="javascript:void(0);" class="cstm-btn solid-btn">Save budget</a> -->
                                                <div class="expenses">
                                                    <h3>Expenses</h3>
                                                    <!--PieChart Starts here-->
                                                    <!-- <div id="piechart"></div> -->
                                                    <div id="bar-chart"></div>
                                                </div>
                                            



                                            </div>
                                             <div class="col-lg-12">
                                                <div class="edi-estimated-cst-box text-left">
                                                    <h4 class="mb-3">Edit the estimated cost</h4>
                                                    <p class="mb-3 text-left">If you edit the total budget, the individual estimated budgets will be automatically recalculated and changed.</p>
                                                    <form class="basicPriceForm" id="basicPriceForm" method="post">
                                                                @csrf
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                            
                                                            <div class="form-group">
                                                                <label class="form-label">ESTIMATED BUDGET</label>
                                                                <input type="text" name="base_price" class="form-control">
                                                                <input type="hidden" name="user_event_id" class="form-control" value="{{$user_event->id}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="btn-wrap d-f a-i-c mt-3">
                                                            <button class="cstm-btn solid-btn mr-3 mt-0">Save</button>
                                                        
                                                            <a href="javascript:void(0);" class="normal-link close" id="save_cancel">Close</a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-box" id="table-box-subcats">
                                            </div>
                                        </div>
                                        <div class="list hide" id="three">


                                        </div>


                                    </div>

                                </div>
                            </div>

                        </div>

              <!--  Category Management Ends block -->
            </div>
        </div>
    </section>
    <!--Tabs Section ends here-->
    
    <!--How it Works section starts here-->
    <section class="how-its-work-sec tool-works">
        <div class="container">
            <div class="sec-heading text-center">          
                  <h2>{{$video_title}}</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="video-container">
                        <figure>
                            <video class="video" id="bVideo" loop="" width="100%" height="100%" poster="{{ $video_video_poster ? url('/uploads').'/'.$video_video_poster : '/frontend/images/video-poster.png'}}">
                                <source src="{{ $video_video ? url('/uploads').'/'.$video_video : '/frontend/videos/Dummy Video.mp4' }}" type="video/mp4">
                            </video>

                            <div id="playButton" class="playButton" onclick="playPause()">
                                <span><i class="fas fa-play-circle"></i></span>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--How it Works section ends here-->  
    @else
    <section class="services-tab-sec">

        <div class="container">
            <div class="sec-card">
                <div class="tab-wrap">
                    You are not autorised to access this page.
                </div>
            </div>
        </div>
    </section>
    @endif

<div class="modal fade" id="add-note-model" role="dialog" aria-labelledby="NoteModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="subnote" id="subnoteForm">
                    @csrf
                    <div class="form-group text-left">
                        <label class="form-label mb-2">Add Note</label>
                        <div class="input-wrap">       
                                <textarea name="note" class="form-control" placeholder="Add Note" style="height: 120px;"></textarea>   
                                <input type="hidden" name="cat_id" value="">     
                        </div>
                    </div>

                    <div class="btn-wrap">
                       <button  type="submit" class="cstm-btn solid-btn " id="subnoteFormSubmit">Save</button>
                    </div>
               </form>
            </div>      
        </div>
    </div>
</div>
    <!-- basic modal -->
<div class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 600px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="newcatForm" method="post">
           <div class="form-group">
               <label class="form-label mb-2">Category Label</label>
               <div class="input-wrap">                                           
               <input type="text" name="cat_label" placeholder="Category" class="form-control">
               <input type="hidden" name="event_id" value="{{$user_event->id}}">
               <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
           </div>
           </div>
           <div class="btn-wrap">
               <button class="cstm-btn solid-btn " id="newcatFormSubmit">Save</button>
           </div>
      </div>      
    </div>
  </div>
</div>


<!-- calculator -->
@include('tools.calculator.calculatormodal')


<p class="cat-holder" dat=""></p>
@endsection
@section('scripts')
<!-- <script type="text/javascript" src="{{url('/')}}/frontend/js/loader.js"></script> -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawCharts);
    function drawCharts() {
        var data = [
        ['catagories', 'Estimated Budget', 'Final Budget'],
      ];
        var event_id = "{{$user_event->id}}";
      $.ajax({
        url: "<?= url(route('user.category.graphData')) ?>" ,
        data:{
          'event_id' : event_id
        },
        dataTYPE: 'json',
        success: function(result){
            for(var i in result){
                data.push(result[i]);
            }
            var barData = google.visualization.arrayToDataTable(data);
        // set bar chart options
      var barOptions = {
        focusTarget: 'category',
        backgroundColor: 'transparent',
        colors: ['#36496c', '#eda208'],
        fontName: 'Open Sans',
        chartArea: {
          left: 50,
          top: 10,
          width: '100%',
          height: '70%'
        },
        bar: {
          groupWidth: '80%'
        },
        hAxis: {
          textStyle: {
            fontSize: 11
          }
        },
        vAxis: {
          minValue: 0,
          maxValue: 1500,
          baselineColor: '#d1d1d1',
          gridlines: {
            color: '#d1d1d1',
            count: 4
          },
          textStyle: {
            fontSize: 11
          }
        },
        legend: {
          position: 'bottom',
          textStyle: {
            fontSize: 12
          }
        },
        animation: {
          duration: 1200,
          easing: 'out',
                startup: true
        }
      };
      // draw bar chart twice so it animates
      var barChart = new google.visualization.ColumnChart(document.getElementById('bar-chart'));
      //barChart.draw(barZeroData, barOptions);
        barChart.draw(barData, barOptions);
        }});

      
      }
</script>

<script>
    $(document).ready(function(){
        $('.edi-estimated-cst-box').css('display','none');  
        $('.edti-budget-btn').click(function(){
            $('.budget-content').css('display','none');
            $('.edi-estimated-cst-box').css('display','block');
        });

        $('#save_cancel').click(function(){
            $('.budget-content').css('display','block');
            $('.edi-estimated-cst-box').css('display','none');
        });

        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Photography', 5],
                ['Venue', 6],
                ['Flowers', 15],
                ['Band', 6],
                ['Cake', 5],
                ['Dress And Attire', 6],
                ['Catering', 40],
                ['Dj', 3],
            ]);

            var options = {
                title: ''
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        $('.selectedCheck').on('click','.getcat',function() {
            $('.getcat').removeClass("selected");
            $(this).addClass("selected");
             getsubcategory();
        });

        
    });



function getsubcategory() {
    var $this = $("body").find('.selectedCheck').find('.selected');
    var val = $this.attr('data-id');
    var event_id = "{{$user_event->id}}";

    $.ajax({
        url: "<?= url(route('user.category.getBudgetCategory')) ?>" ,
        data:{
          'category_id': val,
          'event_id' : event_id
        },
        dataTYPE: 'json',
        success: function(result){
            $('.budget-content').css('display','none');
            $('.edi-estimated-cst-box').css('display','none');
            $('#table-box-subcats').html(result);
        }});
}

function getcategory() {
    var event_id = "{{$user_event->id}}";
    var selected = $('.cat-holder').attr('dat');
    $.ajax({
        url: "<?= url(route('user.category.BudgetCategory')) ?>" ,
        data:{
          'event_id' : event_id,
          'selected' : selected
        },
        dataTYPE: 'json',
        success: function(result){
            $('.selectedCheck').html(result);
        }});
}
    
    function basicPriceForm($this) {
        $.ajax({
            url : "<?= url(route('ajax_editprice')) ?>",
            data : $this.serialize(),
            type: 'POST',  // http method
            dataTYPE:'JSON',
            headers: {
             'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success: function (data) {
                $('.est-cst').html(data);
                $('.budget-content').css('display','block');
                $('.edi-estimated-cst-box').css('display','none');
                getcategory();
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawCharts);
            }
        });
    }

    function newcatForm($this) {
        $.ajax({
            url : "<?= url(route('ajax_newcat')) ?>",
            data : $this.serialize(),
            type: 'POST',  // http method
            dataTYPE:'JSON',
            headers: {
             'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success: function (data) {
               location.reload(true);
            }
        });
    }

    $("body").on('submit','#newcatForm',function(e){
        e.preventDefault();
        newcatForm($(this));
    });

    $("body").on('submit','#basicPriceForm',function(e){
        e.preventDefault();
        basicPriceForm($(this));
    });

    function noteForm($this) {
        $.ajax({
            url : "<?= url(route('ajax_addnote')) ?>",
            data : $this.serialize(),
            type: 'POST',  // http method
            dataTYPE:'JSON',
            headers: {
             'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success: function (data) {
                $('.modal').removeClass('show');
                getsubcategory();
            }
        });
    }

    $("body").on('submit', '.subnote', function(e){
        e.preventDefault();
        noteForm($(this));
    });

    $("body").on('blur','.updateFunction',function(){
         var $this = $(this);
         if($this.data('name') == 'catagory_label'){
            if($this.val().trim().length <= 2){
                alert('Name must have more than 2 characters.');
                return false;
            }
         }
         if($this.data('name') == 'estimated_budget' || $this.data('name') == 'final_budget' || $this.data('name') == 'paid_money'){
            if($this.val() < 0 || $this.val().trim() == ''){
                alert('price must be greater than or equal to 0');
                return false;
            }
         }
         var event_id = "{{$user_event->id}}";
        $.ajax({
           url: "<?= url(route('user.category.updateFunction')) ?>" ,
           data:{
              'id': $this.data('id'),
              'event_id': event_id,
              'name' :$this.data('name'),
              'parent' :$this.data('parent'),
              'value' :$this.val()
           },
           dataTYPE: 'json',
           success: function(result){
                getsubcategory();
                getcategory();
           }});
    });

    $('body').on('click', '#add_note_btn', function(){
        $('#add-note-model').find('textarea').val($(this).data('noteval'));
        $('#add-note-model').find("input[name='cat_id']").val($(this).data('subid'));
    });
    
    $('body').on('click', '.remove-sub', function(){
        var $this = $(this);
        var event_id = "{{$user_event->id}}";
        $.ajax({
           url: "<?= url(route('user.subcategory.removeFunction')) ?>" ,
           data:{
              'id': $this.data('id'),
              'event_id': event_id,
              'parent' :$this.data('parent')
           },
           dataTYPE: 'json',
           success: function(result){
                getsubcategory();
                getcategory();
           }});
        });

    $('body').on('click', '.remove-cat', function(){
        var $this = $(this);
        var event_id = "{{$user_event->id}}";
        $.ajax({
           url: "<?= url(route('user.subcategory.removeFunction')) ?>" ,
           data:{
              'id': $this.data('id'),
              'event_id': event_id,
              'parent' :$this.data('parent')
           },
           dataTYPE: 'json',
           success: function(result){
                location.reload(true);
           }});
        });

    $('body').on('click', '.new-expense', function(){
        var $this = $(this);
        var event_id = "{{$user_event->id}}";
        $.ajax({
           url: "<?= url(route('ajax_newcat')) ?>" ,
           data:{
              'event_id': event_id,
              'parent' :$this.data('parent')
           },
           dataTYPE: 'json',
           success: function(result){
                getsubcategory();
           }
        });
    });

    $("body").click(function(){
        var a = $('body').find('.selectedCheck').find('.selected').data('id');
        $('.cat-holder').attr('dat', a);
    });

    $(document).ready(function(){
        jQuery.validator.addMethod("lettersonly", function(value, element) 
        {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Letters and spaces only please");

        $("#newcatForm").validate({
          rules: {
            cat_label: {
                required: true,
                minlength: 2,
                maxlength: 30,
                lettersonly: true
            }
          },
        });

        $('#newcatFormSubmit').click(function(){
            $(this).attr('disabled', true);
            if($('#newcatForm').valid()){
                $('#newcatForm').submit();
            }else{
                $(this).attr('disabled', false);
                return false;
            }   
        });

        $("#basicPriceForm").validate({
          rules: {
            cat_label: {
                required: true,
                minlength: 2,
                maxlength: 30,
                lettersonly: true
            }
          },
        });

        $('#newcatFormSubmit').click(function(){
            $(this).attr('disabled', true);
            if($('#basicPriceForm').valid()){
                $('#basicPriceForm').submit();
            }else{
                $(this).attr('disabled', false);
                return false;
            }   
        });

            $('#subnoteForm').validate({
              rules: {
                note: {
                    required: true,
                    minlength: 2,
                    maxlength: 150
                }
              },
            });

        $('#subnoteFormSubmit').click(function(){
            $(this).attr('disabled', true);
            if($('#subnoteForm').valid()){
                $('#subnoteForm').submit();
            }else{
                $(this).attr('disabled', false);
                return false;
            }  
        });
});

    </script>
@endsection