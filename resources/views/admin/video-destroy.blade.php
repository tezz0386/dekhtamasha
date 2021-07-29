@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Admin-Video Management', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])
@section('content')
<center><h4>Read Properly Before Delete</h4></center>
<center>
<p>
	No Longer This Video after deleted, please make sure if you want to delete this video
</p>
</center>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<form action="{{route('video.destroy', $video)}}" method="post">
			@csrf
			@method('delete')
			<a href="{{route('video.index')}}" class="btn btn-primary">Cancel</a>
			<button class="btn btn-primary float-right" type="submit">Delete</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
@endsection