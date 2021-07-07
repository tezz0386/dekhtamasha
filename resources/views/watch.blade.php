@extends('layouts.app1')
@section('content')
<div class="row">
   <div class="col-md-8 col-sm-12 col-12 col-xl-8 col-lg-8">
      <iframe width="100%" height="315" src="{{$video->url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
      
      </iframe>
      <label class="title mt-3">
         {{$video->title}}
      </label>
      <br>
      <label>
         {{$video->views}} Views - 3 jul 2021
         <label class="ml-5" style="font-size: 18px;" id="like-label">
            <a href="#" id="like"
               @if(auth()->check())
               @foreach($video->likes as $like)
               @if($like->video_id == $video->id && $like->uid == auth()->user()->id)
               class="like"
               @endif
               @endforeach
               @endif
               >
               <i class="fas fa-heart" ></i>
            </a>
            <label id="like-text">{{$video->like}}</label>
         </label>
         <label class="ml-5" style="font-size: 18px;" id="dislike-label">
            <a href="#" id="dislike"
               @if(auth()->check())
               @foreach($video->dislikes as $dislike)
               @if($dislike->video_id == $video->id && $dislike->uid == auth()->user()->id)
               class="like"
               @endif
               @endforeach
               @endif
               ><i class="fas fa-heart-broken"></i>
            </a>
            <label id="dislike-text">{{$video->dislike}}</label>
         </label>
      </label>
      <hr style="border-style: dotted none; border-width: 5px; color: black;" class="mt-0">
      <p>
         {!! substr(strip_tags($video->description),0,500) !!}................
      </p>
      <a  href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
         Show More
      </a>
      <div class="collapse" id="collapseExample">
         {!! substr($video->description, 500, strlen($video->description)) !!}
      </div>
      <hr style="border-style: dotted none; border-width: 5px; color: black;" class="mt-0">
      <h5>{{count($comments)}} Comments</h5>
      <label>
         @if(count($comments)<=0) Be the first Comment @endif
      </label>
      <br>
      <div class="input-group mb-3 mt-3">
         <div class="input-group-prepend">
            @if(auth()->check())
            <div style="border-radius: 10px; background-color: grey; color: white; font-size: 35px; width: 45px; text-align: center; margin-top: -9px;">{{substr(auth()->user()->name, 0, 1)}}</div>
            @else
            <i class="fa fa-user" style="font-size: 35px;"></i>
            @endif
         </div>
         <input type="text" class="form-control comment-box" placeholder="Add a public comment" aria-label="Username" aria-describedby="basic-addon1" id="comment" name="comment">
      </div>
      <button type="button" class="btn btn-primary float-right" id="button-comment" disabled>Comment</button>
      <button type="button" class="btn btn-info float-right mr-2" id="button-comment-cancel">Cancel</button>
      <div id="new-comment">
         
      </div>
      @if(isset($comments) && count($comments)>0)
      @foreach($comments as $comment)
      <div class="comment-div" id="comment-div{{$comment->id}}">
         <div class="input-group mb-3">
            <div class="input-group-prepend">
               <div style="border-radius: 10px; background-color: grey; color: white; font-size: 35px; width: 45px; text-align: center;">{{substr($comment->users->name, 0, 1)}}</div>
            </div>
            <label class="ml-2">
               <label class="title">{{$comment->users->name}}</label><label class="ml-2">1 week ago</label>
               @if(auth()->check())
               @if($comment->users->id == auth()->user()->id)
               <div class="dropdown show float-right">
                  <a class="dropdown-toggle ml-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black; font-size:20px;">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <a class="dropdown-item" href="#" data-comment="{{$comment->comment}}" data-id="{{$comment->id}}" id="edit-comment{{$comment->id}}">Edit</a>
                     <a class="dropdown-item" href="#" data-id="{{$comment->id}}" id="delete-comment{{$comment->id}}">Delete</a>
                  </div>
               </div>
               @endif
               @endif
               <br>
               <label>{{$comment->comment}}</label>
            </label>
         </div>
      </div>
      @endforeach
      @endif
   </div>
   <div class="col-md-4 col-lg-4 col-xl-4 d-sm-none d-md-block d-none d-sm-block ml-0">
      @if($playlistVideos && count($playlistVideos)>0)
      @foreach($playlistVideos as $playlistVideo)
      <a href="{{route('user.getWatch', $playlistVideo->token_id)}}">
         <div class="row mb-2">
            <div class="col-7" style="margin-right: -27px;">
               <img src="{{asset('image/thumbnail/'.$playlistVideo->thumbnail)}}" class="img-fluid">
            </div>
            <div class="col-5" style="color: black;">
               <label><b>{{substr($playlistVideo->title, 0, 25)}}</b></label>
               <label style="font-size: 12px;">{{$playlistVideo->views}} View <br> 6 hours ago</label>
            </div>
         </div>
      </a>
      @endforeach
      @endif
   </div>
</div>
@endsection
@section('scripts')
@include('pages.script')
@endsection