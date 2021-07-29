@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Admin-Video Management', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])
@section('content')
<form action="{{route('video.update', $video)}}" method="post" enctype="multipart/form-data">
	@csrf
	@method('patch')
	<div class="container">
		<h4>Details</h4>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text  pl-2 pr-2" id="basic-addon1">URL</span>
			</div>
			<input type="text" class="form-control" placeholder="URL of video (Required)" aria-label="Username" aria-describedby="basic-addon1" name="url1" value="{{ $video->url}}">
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Title</span>
			</div>
			<input type="text" class="form-control" placeholder="Title (Required)" aria-label="Username" aria-describedby="basic-addon1" name="title" value="{{ $video->title}}">
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Tags</span>
			</div>
			<select class="js-example-tokenizer" multiple="multiple" style="width:100%; height: 150px;" name="tags[]">
				@foreach($video->assistants as $assistant)<option selected="selected">{{$assistant->tag}}</option>@endforeach
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text pl-2 pr-2" id="basic-addon1">Description</span>
			</div>
			<textarea name="description" placeholder="Write some information about your video" rows="5" cols="100%" id="editor1">{{ $video->description}}</textarea>
		</div>
		<h5>Thumbnail</h5>
		<label class="label-font-size">Upload your thumbnail image which will display before video preview, so that make more attention to the viewer</label>
		<div class="image-upload" id="image-upload">
			<label for="file-input">
				<img src="{{asset('image/thumbnail/'.$video->thumbnail)}}" height="105px;" id="thumbnail_image">
			</label>
			<input id="file-input" type="file" name="thumbnail"  style="display: none;">
		</div>
		<h5 class="mt-2">Playlist</h5>
		<label class="label-font-size">Select your playlist where this video will be exist</label>
		<button class="float-right btn btn-primary" id="create-playlist" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-plus">Create new Playlist</i></button>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Select Playlist</span>
			</div>
			<select name="playlist" class="form-control" id="playlist">
				@if(isset($playlists) && count($playlists)>0)
				@foreach($playlists as $playlist)
				@if($playlist->id == $video->playlist_id)
				<option value="{{$video->playlist_id}}">{{$playlist->title}}</option>
				@endif
				@if($playlist->id != $video->playlist_id)
				<option value="{{$playlist->id}}">{{$playlist->title}}</option>
				@endif
				@endforeach
				@endif
			</select>
		</div>
		<br>
		<a  href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:blue; text-transform: uppercase;">
			Show More
		</a>
		<div class="collapse" id="collapseExample">
			<div class="input-group mb-3">
				<div class="input-group-prepend bg-info">
					<span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Category</span>
				</div>
				<select name="category" class="form-control">
					@if(isset($categories) && count($categories)>0)
					@foreach($categories as $category)
					@if($category->id == $video->category_id)
					<option value="{{$video->category_id}}">
						{{$category->title}}
					</option>
					@endif
					@if($category->id != $video->category_id)
					<option value="{{$category->id}}">
						{{$category->title}}
					</option>
					@endif
					@endforeach
					@endif
				</select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend bg-info">
					<span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Language</span>
				</div>
				<select name="language" class="form-control">
					@if(isset($languages) && count($languages)>0)
					@foreach($languages as $language)
					@if($language->id == $video->language_id)
					<option value="{{$video->language_id}}">
						{{$language->title}}
					</option>
					@endif
					@if($language->id= $video->language_id)
					<option value="{{$language->id}}">
						{{$language->title}}
					</option>
					@endif
					@endforeach
					@endif
				</select>
			</div>
		</div>
		<h4>Visibility</h4>
		<div class="card card-body">
			<ul class="list-unstyled radio-list">
				<li>
					<label><input type="radio" name="visibility"  value="1" @if($video->visibility == 1 ) checked="checked" @endif><b>  Public</b></label>
				</li>
				<li>
					<label><input type="radio" name="visibility" value="2" @if($video->visibility == 2 ) checked="checked" @endif><b>  Private</b></label>
				</li>
			</ul>
			<div class="card card-body">
				<ul class="list-unstyled radio-list">
					<li>
						<label><input type="radio" name="status" value="1" @if($video->status == 1 ) checked="checked" @endif><b>  Publish Now</b></label>
					</li>
					<li>
						<label><input type="radio" name="status" value="2" @if($video->status == 2 ) checked="checked" @endif><b>  Suspend</b></label>
					</li>
				</ul>
			</div>
		</div>
		<button type="submit" class="btn btn-primary float-right">Submit</button>
	</div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
	$(".js-example-tokenizer").select2({
dropdownParent: $('#exampleModalCenter'),
tags: true,
tokenSeparators: [','],
});
</script>
@endsection