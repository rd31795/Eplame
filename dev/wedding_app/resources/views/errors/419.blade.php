@extends('errors/illustrated-layout')
@section('style')
<style>
	#error_page_419 .bg-purple-light{
		background-color:#f67c48 ! important;
	}
</style>
@endsection
@section('code', '419')
@section('title', __('Page Expired'))

@section('image')
    <div style="background-image: url({{ asset('svg/errors/asd.png') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, your session has expired. Please refresh and try again.'))
@section('script')
<script>
	document.querySelector("body").setAttribute('id','error_page_419');
</script>
@endsection