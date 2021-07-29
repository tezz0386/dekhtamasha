@extends('layouts.app1')
@section('content')
<div class="row">
   @if(isset($videos) && count($videos)>0)
   @foreach($videos as $video)
   <div class="col-md-3 col-lg-3 col-sm-12 col-xl-12 col-12 col-sm-12">
      <a href="{{route('user.getWatch', $video->token_id)}}" style="text-decoration: none;">
         <div class="card card-body p-0" style="color: black;">
            <img src="{{asset('image/thumbnail/'.$video->thumbnail)}}">
            {{substr($video->title, 0, 55)}}
            <label>{{$video->views}} View-{{$video->created_at->diffForHumans()}} </label>
         </div>
      </a>
   </div>
   @endforeach
   @else
   <div>
      <center>
      <label>Sorry !! The content will uploaded as soon as possible</label>
      </center>
   </div>
   @endif
</div>
@endsection