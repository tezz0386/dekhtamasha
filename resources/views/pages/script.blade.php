<script type="text/javascript">
$(document).ready(function(){
   $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
   });
var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
var comment_id;
$(document).on('click', '#like', function(e){
e.preventDefault();
if(loggedIn){
   $.ajax({
                 url:'{{route('user.video.like')}}',
                 method:'post',
                 data:{
                    'video_id': {{$video->id}},
                 },
                 dataType:'json',
                 success:function(data)
                 {
                    $('#like-label').html(data.likeOutput);
                    $('#dislike-label').html(data.dislikeOutput);
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

    });

}else{
window.location.href = '{{route('login')}}';
}
});


$(document).on('click', '#dislike', function(e){
e.preventDefault();
if(loggedIn){
   $.ajax({
                 url:'{{route('user.video.dislike')}}',
                 method:'post',
                 data:{
                    'video_id': {{$video->id}},
                 },
                 dataType:'json',
                 success:function(data)
                 {
                    $('#like-label').html(data.likeOutput);
                    $('#dislike-label').html(data.dislikeOutput);
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

    });

}else{
window.location.href = '{{route('login')}}';
}
});


$(document).on('click', '#comment', function(){
   // alert();
   if(loggedIn){
         
   }else{
      window.location.href = '{{route('login')}}';
   }
});

    $('#comment').on('keyup', function(e){
        if(!$(this).val()){
            $('#button-comment').prop('disabled', true);
        } else{
            $('#button-comment').prop('disabled', false);
        }
      });

    $('#button-comment-cancel').on('click', function(e){
         $('#comment').val('');
         $('#button-comment').prop('disabled', true);
    });
    $('#button-comment').on('click', function(e){
         e.preventDefault();
         var comment = $('#comment').val();
         $('#comment').val('');
         $(this).prop('disabled', true);
         $.ajax({
                 url:'{{route('user.comment.store')}}',
                 method:'post',
                 data:{
                    'video_id': {{$video->id}},
                    'comment': comment,
                    'comment_id':comment_id,
                 },
                 dataType:'json',
                 success:function(data)
                 {
                    $('#new-comment').html(data.newComment);

                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

          });
    });


    @if(isset($comments) && count($comments)>0)
      @foreach($comments as $comment)
       $('#edit-comment{{$comment->id}}').on('click', function(e){
            e.preventDefault();
            $('#comment').val($(this).data('comment'));
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#comment").offset().top
            }, 150);
            comment_id = $(this).data('id');
            $('#button-comment').prop('disabled', false);
            $('#comment-div{{$comment->id}}').hide();
       });
        $('#delete-comment{{$comment->id}}').on('click', function(e){
            e.preventDefault();
            var comment_id = $(this).data('id');
            $('#comment-div{{$comment->id}}').hide();
             $.ajax({
                 url:'{{route('user.comment.destroy')}}',
                 type:'DELETE',
                 data:{
                    'comment_id': comment_id,
                 },
                 dataType:'json',
                 success:function(data)
                 {
                    console.log(data);
                 },
                 error: function(e) {
                  console.log(e.responseText);
                 }

    });
       });
      @endforeach
   @endif

});



</script>