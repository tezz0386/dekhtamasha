<div class="modal" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Play List Creation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="input-group mb-3">
					<div class="input-group-prepend bg-info">
						<span class="input-group-text  pl-2 pr-2" id="basic-addon1">Playlist Title</span>
					</div>
					<input type="text" class="form-control" placeholder="Title (Required)" aria-label="Username" aria-describedby="basic-addon1" name="playlist_title" id="playlist_title">
				</div>
				<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="playlist-store">Submit</button>
			</div>
		</div>
	</div>
</div>