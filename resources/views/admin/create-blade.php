@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Admin-Video Management', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])
@section('content')
<div class="bs-example">
	<div class="progress">
		<div class="progress-bar bg-success" style="width: 50%">
			Details
		</div>
		<div class="progress-bar bg-info" style="width: 50%">
			Publish
		</div>
	</div>
</div>
<div class="container">
	<h4>Visibility</h4>
	<div class="card card-body">
		<ul class="list-unstyled radio-list">
			<li>
				<label><input type="radio" name="visibility" checked="checked" value="1"><b>  Public</b></label>
			</li>
			<li>
				<label><input type="radio" name="visibility" value="2"><b>  Private</b></label>
			</li>
		</ul>
		<div class="card card-body">
			<ul class="list-unstyled radio-list">
				<li>
					<label><input type="radio" name="status" value="1" checked="checked"><b>  Publish Now</b></label>
				</li>
				<li>
					<label><input type="radio" name="status" value="2"><b>  Suspend</b></label>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<h4>Details</h4>
	<div class="input-group mb-3">
		<div class="input-group-prepend bg-info">
			<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Title</span>
		</div>
		<input type="text" class="form-control" placeholder="Title (Required)" aria-label="Username" aria-describedby="basic-addon1">
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend bg-info">
			<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Tags</span>
		</div>
		<select class="js-example-tokenizer" multiple="multiple" style="width:100%; height: 150px;" name="tags[]">
		</select>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend bg-info">
			<span class="input-group-text  pl-2 pr-2" id="basic-addon1">URL</span>
		</div>
		<input type="text" class="form-control" placeholder="URL of video (Required)" aria-label="Username" aria-describedby="basic-addon1" name="url">
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend bg-info">
			<span class="input-group-text pl-2 pr-2" id="basic-addon1">Description</span>
		</div>
		<textarea name="description" placeholder="Write some information about your video" rows="5" cols="100%"></textarea>
	</div>
	<h5>Thumbnail</h5>
	<label class="label-font-size">Upload your thumbnail image which will display before video preview, so that make more attention to the viewer</label>
	<div class="image-upload" id="image-upload">
		<label for="file-input">
			<img src="{{asset('image/image-upload.png')}}" height="105px;" id="thumbnail_image">
		</label>
		<input id="file-input" type="file" name="thumbnail"  style="display: none;">
	</div>
	<h5 class="mt-2">Playlist</h5>
	<label class="label-font-size">Select your playlist where this video will be exist</label>
	<button class="float-right btn btn-primary"><i class="fas fa-plus">Create new Playlist</i></button>
	<select name="playlist" class="form-control">
		<option>Select Playlist</option>
		<option>Tharu Song</option>
		<option>Hindi Song</option>
		<option>Mithali Song</option>
	</select>
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
				<option>Select Category</option>
				<option>Entertainment</option>
				<option>Science & Technology</option>
				<option>Beauty and Fashion</option>
				<option>Nothing</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend bg-info">
				<span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Language</span>
			</div>
			<select name="language" class="form-control">
				<option>Select Language</option>
				<option>English</option>
				<option>Tharu</option>
				<option>Hindi</option>
				<option>Mithali</option>
			</select>
		</div>
	</div>
</div>
@endsection


