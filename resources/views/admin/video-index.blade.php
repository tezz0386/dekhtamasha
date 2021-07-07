@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Admin-Video Management', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])
@section('content')
<table class="table mytable">
    <thead>
        <tr>
            <th>
                <input type="checkbox" name="select_all" id="select_all">
            </th>
            <th colspan="2">
                Video
            </th>
            <th>Visibility</th>
            <th>Status</th>
            <th>Date</th>
            <th>Views</th>
            <th>Like</th>
            <th>Dislike</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($videos) && count($videos)>0)
        @foreach($videos as $video)
        <tr>
            <td>
                <input type="checkbox" name="select_all" id="select{{$video->id}}">
            </td>
            <td>
                <img src="{{asset('image/thumbnail/'.$video->thumbnail)}}" height="70px" width="150px">
            </td>
            <td>
                {{substr($video->title, 0, 55)}}
                <div class="my-overlay">
                   <a href="{{route('video.edit', $video)}}" class="ml-1 p-2"><i class="fa fa-edit"></i></a>
                   <a href="{{route('video.show', $video)}}" class="ml-1 p-2 "><i class="fa fa-trash"></i></a>
                   <a href="{{route('user.getWatch', $video->token_id)}}" class="ml-1 p-2"><i class="fa fa-eye"></i></a>
                </div>
            </td>
            <td>
                @if($video->visibility == 1)
                Public
                @else
                Private
                @endif
            </td>
            <td>
                @if($video->status == 1)
                Published
                @else
                Draft
                @endif
            </td>
            <td>
                {{$video->created_at}}
            </td>
            <td>
                {{$video->views}}
            </td>
            <td>{{$video->like}}</td>
            <td>{{$video->dislike}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="9">
                <center>Not Uploaded At Please Upload First <a class="nav-link" href="#" style="color: white; font-size: 18px;">
                    <img src="{{asset('image/create-video.png')}}" data-toggle="modal" data-target="#exampleModalCenter">
                </a></center>
            </td>
        </tr>
        @endif
    </tbody>
</table>
@endsection