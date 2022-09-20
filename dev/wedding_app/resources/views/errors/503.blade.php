@php
  $data=\DB::table('maintenance')->whereId(1)->first();
@endphp
@extends('errors/illustrated-layout')
@section('title', __($data->page_title))
@section('image')
    <div style="background-image: url({{ asset($data->image) }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', $data->description)
