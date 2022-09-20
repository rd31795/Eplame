@extends('errors/illustrated-layout')
@section('style')
<style>
#error_page_401 img.angry_image {
    width: 100%;
    max-width: 120px;
    margin: 0 auto 20px;
    display: block;
}

#error_page_401 .bg-purple-light {
    display: none;
}

#error_page_401 .leading-normal {
    text-align: center;
}
</style>

@endsection
@section('error_code')
   <img src="{{ asset('svg/errors/angry.png') }}" class="angry_image"/>
@endsection
@section('title', __('Unauthorized'))
@section('image')
    <div style="background-image: url({{ asset('svg/errors/error-401.png') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
@section('message', __('Sorry, you are not authorized to access this page.'))
@section('script')
<script>
	document.querySelector("body").setAttribute('id','error_page_401');
</script>
@endsection

