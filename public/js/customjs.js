

$.ajaxSetup({
headers: {
 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var video_title, url1, playlist, thumbnail, category, description, tags, visibility, status, language;

$(document).on('click', '#uploadurl', function(e){
		e.preventDefault();
        $('#exampleModalCenter').css('margin-top', '-146px');
        $('#modal-body').html('<div class="bs-example">   <div class="progress">      <div class="progress-bar bg-info" style="width: 50%">           Details         </div>      <div class="progress-bar bg-danger" style="width: 50%">             Publish         </div>  </div> </div><div class="container">    <h4>Details</h4>    <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">URL</span>      </div>      <input type="text" class="form-control" placeholder="URL of video (Required)" aria-label="Username" aria-describedby="basic-addon1" name="url" id="url">     </div> <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Title</span>        </div>      <input type="text" class="form-control" placeholder="Title (Required)" aria-label="Username" aria-describedby="basic-addon1" id="video_title" name="video_title">   </div>  <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text pl-2 pr-2" id="basic-addon1">Description</span>       </div>      <textarea name="description" placeholder="Write some information about your video" rows="5" cols="100%" id="description"></textarea>     </div>  <h5>Thumbnail</h5>  <label class="label-font-size">Upload your thumbnail image which will display before video preview, so that make more attention to the viewer</label>   <div class="image-upload" id="image_upload">        <label for="file-input">            <img src="" height="105px;" id="thumbnail_image">        </label>        <input id="file-input" type="file" name="thumbnail" style="display:none;">   </div>  <h5 class="mt-2">Playlist</h5>  <label class="label-font-size">Select your playlist where this video will be exist</label>  <button class="float-right btn btn-primary" id="create-playlist" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-plus">Create new Playlist</i></button>                     <div class="input-group mb-3">                     <div class="input-group-prepend bg-info">                         <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Select Playlist</span>                     </div>                     <select name="playlist" class="form-control" id="playlist">         </select>                 </div>           <br>    <a  href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:blue; text-transform: uppercase;">        Show More   </a>    <div class="collapse" id="collapseExample">         <div class="input-group mb-3">          <div class="input-group-prepend bg-info">               <span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Category</span>           </div><select name="category" class="form-control" id="category"></select>       </div>      <div class="input-group mb-3"> <div class="input-group-prepend bg-info">               <span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Language</span>           </div>          <select name="language" class="form-control" id="language">                           </select>       </div>  <div class="input-group mb-3">       <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Tags</span>         </div>      <select class="js-example-tokenizer" multiple="multiple" style="width:100%; height: 150px;" name="tags[]" id="tags">      </select>   </div>  </div> </div>');
        $('#category').html('<option value="">Select Category</option>');
        $('#playlist').html('<option value="">Select Playlist</option>');
        $('#language').html('<option value="">Select Laguage</option>');
        var imageUrl = "/image/image-upload.png"; 
        $('#thumbnail_image').attr('src', imageUrl);$('#footer').html('<button type="button" class="btn btn-secondary"  id="back">Back</button><button type="button" class="btn btn-primary" id="next">Next</button>');
        $(".js-example-tokenizer").select2({
         dropdownParent: $('#exampleModalCenter'),
         tags: true,
         tokenSeparators: [','],
        });
        CKEDITOR.replace( 'description' );
            $.ajax({
                 url:"/admin/categories",
                 method:'get',
                 dataType:'json',
                 success:function(data)
                 {
                    $('#category').append(data.category_data);
                    $('#playlist').append(data.playlist_data);
                    $('#language').append(data.language_data);
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

            });


});



$(document).on('click','#back', function()
{
    $('#exampleModalCenter').css('margin-top', '0px');
    $('#modal-body').html('<hr style="border-style: dotted none; border-width: 5px; color: black;" class="mt-0">          <center>            <i class="fas fa-upload" style="font-size: 100px;"></i><br>            <br>            <label>Upload Your Video URL here</label><br>            <button type="button" class="btn btn-primary" style="background-color: blue; color: white;" id="uploadurl">Upload Your URL here</button>          </center>          <label>By submmiting you videos on <a href="#">Dekhtamasha</a> please ensure that the all <a href="#">terms, conditions and policy </a></label>          <br>          <label>             Please make sure that you do not violate others copyright or privacy rights <a href="#">Learn more</a></label>');
    $('#footer').html(' <button type="button" class="btn btn-secondary" data-dismiss="modal" id="back">Close</button>         <button type="button" class="btn btn-primary">Cancel</button>');
});


$(document).on('click', '#create-playlist', function(e){
    e.preventDefault();
    
});

$(document).on('click', '#next', function(e){
     e.preventDefault();
     video_title=$('#video_title').val();
     description = CKEDITOR.instances['description'].getData();;
     url1 = $('#url').val();
     playlist = $('#playlist').val();
     category = $('#category').val();
     thumbnail = $('#thumnail').val();
     tags = $('#tags').val();
     language = $('#language').val();
     thumbnail = $('#file-input').prop("files")[0];
    $('#modal-body').html('<div class="bs-example">     <div class="progress">      <div class="progress-bar bg-success" style="width: 50%">            Details         </div>      <div class="progress-bar bg-info" style="width: 50%">           Publish         </div>  </div> </div> <div class="container">   <h4>Visibility</h4>     <div class="card card-body">        <ul class="list-unstyled radio-list">           <li>                <label><input type="radio" name="visibility" checked="checked" value="1" class="visibility"><b>  Public</b></label>            </li>           <li>                <label><input type="radio" name="visibility" value="2" class="visibility"><b>  Private</b></label>             </li>       </ul>       <div class="card card-body">            <ul class="list-unstyled radio-list">               <li>                    <label><input type="radio" name="status" value="1" checked="checked" class="status"><b>  Publish Now</b></label>               </li>               <li>                    <label><input type="radio" name="status" value="2" class="status"><b>  Suspend</b></label>                 </li>           </ul>       </div>  </div> </div>');
    $('#footer').html('<button type="button" class="btn btn-secondary"  id="back1">Back</button><button type="button" class="btn btn-primary" id="submit">Submit</button>');
    $('#exampleModalCenter').css('margin-top', '-23px');

});

$(document).on('click', '#back1', function(e){
        e.preventDefault();
        $('#exampleModalCenter').css('margin-top', '-130px');
        $('#modal-body').html('<div class="bs-example">   <div class="progress">      <div class="progress-bar bg-info" style="width: 50%">           Details         </div>      <div class="progress-bar bg-danger" style="width: 50%">             Publish         </div>  </div> </div><div class="container">    <h4>Details</h4>    <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">URL</span>      </div>      <input type="text" class="form-control" placeholder="URL of video (Required)" aria-label="Username" aria-describedby="basic-addon1" name="url" id="url">     </div> <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Title</span>        </div>      <input type="text" class="form-control" placeholder="Title (Required)" aria-label="Username" aria-describedby="basic-addon1" id="video_title" name="video_title">   </div>  <div class="input-group mb-3">      <div class="input-group-prepend bg-info">           <span class="input-group-text pl-2 pr-2" id="basic-addon1">Description</span>       </div>      <textarea name="description" placeholder="Write some information about your video" rows="5" cols="100%" id="description"></textarea>     </div>  <h5>Thumbnail</h5>  <label class="label-font-size">Upload your thumbnail image which will display before video preview, so that make more attention to the viewer</label>   <div class="image-upload" id="image_upload">        <label for="file-input">            <img src="" height="105px;" id="thumbnail_image">        </label>        <input id="file-input" type="file" name="thumbnail" style="display:none;">   </div>  <h5 class="mt-2">Playlist</h5>  <label class="label-font-size">Select your playlist where this video will be exist</label>  <button class="float-right btn btn-primary" id="create-playlist" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-plus">Create new Playlist</i></button>                     <div class="input-group mb-3">                     <div class="input-group-prepend bg-info">                         <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Select Playlist</span>                     </div>                     <select name="playlist" class="form-control" id="playlist">         </select>                 </div>           <br>    <a  href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:blue; text-transform: uppercase;">        Show More   </a>    <div class="collapse" id="collapseExample">         <div class="input-group mb-3">          <div class="input-group-prepend bg-info">               <span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Category</span>           </div><select name="category" class="form-control" id="category"></select>       </div>      <div class="input-group mb-3"> <div class="input-group-prepend bg-info">               <span class="input-group-text pl-2 pr-2" id="basic-addon1">Select Language</span>           </div>          <select name="language" class="form-control" id="language">                           </select>       </div>  <div class="input-group mb-3">       <div class="input-group-prepend bg-info">           <span class="input-group-text  pl-2 pr-2" id="basic-addon1">Tags</span>         </div>      <select class="js-example-tokenizer" multiple="multiple" style="width:100%; height: 150px;" name="tags[]" id="tags">      </select>   </div>  </div> </div>');
        $('#category').html('<option value="">Select Category</option>');
        $('#playlist').html('<option value="">Select Playlist</option>');
        $('#language').html('<option value="">Select Laguage</option>');
        var imageUrl = "/image/image-upload.png";
        $('#thumbnail_image').attr('src', imageUrl);
        $('#footer').html('<button type="button" class="btn btn-secondary"  id="back">Back</button><button type="button" class="btn btn-primary" id="next">Next</button>');
        $(".js-example-tokenizer").select2({
         dropdownParent: $('#exampleModalCenter'),
         tags: true,
         tokenSeparators: [','],
       });
        CKEDITOR.replace( 'description' );

        $.ajax({
                 url:"/admin/categories",
                 method:'get',
                 dataType:'json',
                 success:function(data)
                 {
                    $('#category').append(data.category_data);
                    $('#playlist').append(data.playlist_data);
                    $('#language').append(data.language_data);
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

            });

    
});

$(document).on('click', '#playlist-store', function(){
    var playlist_title = $('#playlist_title').val();
    var _token = $('#token').val();
    $.ajax({
                 url:"/admin/playlist",
                 method:'post',
                 data:{
                    'title': playlist_title,
                    '_token': _token
                 },
                 dataType:'json',
                 success:function(data)
                 {
                    $('#playlist').html(data.playlist_data);
                    alert("Successfully Created")
                    $('#playlist_title').val('');
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

    });
});
$(document).on('click', '#submit', function(e){
    e.preventDefault();
    visibility = $('input[name="visibility"]:checked').val();
    status = $('input[name="status"]:checked').val();
    var _token = $('#token').val();
    var formData = new FormData();
    formData.append("title", video_title);
    formData.append("playlist", playlist);
    formData.append("category", category);
    formData.append("url1", url1);
    formData.append("description", description);
    formData.append("tags", tags);
    formData.append("language", language);
    formData.append("thumbnail", thumbnail);
    formData.append("visibility", visibility);
    formData.append("status", status);
    formData.append("_token", _token);


    $.ajax({
                 url:"/admin/video",
                 method:'post',
                 data:formData,
                 dataType:'json',
                 processData: false,
                 contentType: false,
                 success:function(data)
                 {
                    
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

    });



    alert('Successfully Uploaded');
})

$(document).on('change', '#file-input', function(evt) {
        $('#image_upload').removeAttr('hidden');
        readURL(this);
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#thumbnail_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}









