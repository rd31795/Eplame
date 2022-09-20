@extends('errors/illustrated-layout')
@section('style')
<style>
#error_page_429 img.angry_image {
    width: 100%;
    max-width: 120px;
    margin: 0 auto 20px;
    display: block;
}

#error_page_429 .bg-purple-light {
    display: none;
}

#error_page_429 .leading-normal {
    text-align: center;
}
</style>

@endsection
@section('title', __('Too Many Requests'))
@section('error_code')
   <img src="{{ asset('svg/errors/sad.png') }}" class="angry_image"/>
@endsection
@section('image')
    <div style="background-image: url({{ asset('/svg/errors/4705517.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
@section('message', __('Sorry, you are making too many requests to our servers.'))
@section('script')
<script>
	document.querySelector("body").setAttribute('id','error_page_429');
</script>
@endsection