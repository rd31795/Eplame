<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="https://www.eplame.com/dev/frontend/css/styles.css">
@extends('layouts.home')
@section('content')
<section class="main-banner cust-banner-height Registration-banner" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Registration is Close</h1>
        </div>
    </div>
</section>
<!-- Modal -->
@endsection
@section('scripts')
<script src="{{url('/js/registerform.js')}}"></script>
<style type="text/css">
    /*210913*/
.Order-Summary-head h2 {
    font-size: 22px;
    color: #35486b;
}
.Order-Summary-inner-head {
    margin: 15px 0;
}
.Order-Summary-inner-head-1 {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}
.Order-Summary-wrapper h5 {
    color: #35486b;
    font-size: 19px;
    margin: 0;
}
.animated.step3 {
    width: 100%;
}
.sub-total div {
    display: flex;
    justify-content: space-between;
}
.Order-Summary-inner-head-1 h5 {
    color: #fff;
}
.Order-Summary-inner-head-1 {
    background: #35486b;
    padding: 5px 10px;
}
.admission-item {
  display: flex;
  justify-content: space-between;
}
.admission-item h5 {
    font-size: 15px!important;
}
.sub-total-inner h5 {
    font-size: 15px;
}
.payment-wrapper {
    margin: 30px 0 20px;
}
.payment-method-div {
  display: block;
}
</style>
@endsection