<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $comment='';
        $user = Auth::user();
        if($request->comment_id && $request->comment_id != ''){
            $comment = Comment::find($request->comment_id);
        }else{
             $comment = new Comment();
             $comment->uid = $user->id;
             $comment->video_id = $request->video_id;
        }
        $comment->comment = $request->comment;
        $user->comments()->save($comment);
        $output = '<div class="input-group mb-3">
         <div class="input-group-prepend">
            <div style="border-radius: 10px; background-color: grey; color: white; font-size: 35px; width: 45px; text-align: center;">'.substr($comment->users->name, 0, 1).'</div>
         </div>
         <label class="ml-2">
            <label class="title">'.$comment->users->name.'</label><label class="ml-2">1 week ago</label><br>
            <label>'.$comment->comment.'</label>
         </label>
        </div>';
        $data = array(
                'newComment'=>$output,
        );
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $comment = Comment::find($request->comment_id);
        // return $comment;
        $comment->delete();
        return json_encode($comment);
    }
}
