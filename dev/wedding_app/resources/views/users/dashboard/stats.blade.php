@extends('users.layouts.layout') @section('content')

<style type="text/css">

</style>

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">My Statistics</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('user_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0);">Statistics</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">

        <div class="col-xl-12 col-md-12">
            <ul class="stats-box"> 
                <li>
                    <a href="{{ route('user_events')}}">
                    <span><i class="fas fa-calendar-week"></i> Events</span> 
                        {{Auth::user()->events->count()}}
                    </a>
                    </li>

                <li class="bg1">
                    <a href="{{ route('user_orders') }}">
                    <span>Orders</span>
                    {{Auth::user()->orders->count()}}
                    </a>
                </li>
                <li class="bg2">
                     <a href="{{ route('forum.user.discussions', Auth::user()->id) }}">
                    <span>Discussions</span>
                    {{Auth::user()->discussions->count()}}
                    </a>
                </li>
                <li class="bg3"> 
                    <a href="{{ route('forum.user.photos', Auth::user()->id) }}">
                    <span>Photos</span>
                    {{Auth::user()->discussionfiles->count()}}
                </a>
                </li>
                <li class="bg4">
                    <a href="{{ route('forum.user.videos', Auth::user()->id) }}">
                    <span>Videos</span>
                    {{Auth::user()->discussionvideos->count()}}
                </a>
                </li>
                <li class="bg5">
                     <a href="{{ route('forum.user.friends', Auth::user()->id) }}">
                    <span>Friends</span>
                    {{(Auth::user()->senderfriends->count() + Auth::user()->recieverfriends->count())}}
                </a></li>
                <li class="bg6">
                     <a href="{{ route('user_show_favourite_vendors') }}">
                    <span>Favourite vendor</span>
                    {{Auth::user()->favouriteVendors->count()}}
                </a></li>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection 
@section('scripts')
<script>
    
</script>

@endsection