<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Playlist;
use App\Models\Video;
use App\Models\VideoAssistant;
use Auth;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::where('uid', Auth::user()->id)->orderByDesc('created_at')->get();
         return view('admin.video-index', ['videos'=>$videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('admin.video-create');
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
        $video = new Video();
        $token_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12);
        $file = $request->file('thumbnail');
        $destinationPath = 'image/thumbnail/';
        $originalFile = $file->getClientOriginalName();
        $filename=$token_id.$originalFile;
        $file->move($destinationPath, $filename);
        $video->title=$request->title;
        $video->description=$request->description;
        $video->playlist_id = $request->playlist;
        $video->url = $request->url1;
        $video->category_id = $request->category;
        $video->language_id=$request->language;
        $video->visibility=$request->visibility;
        $video->status=$request->status;
        $video->uid=Auth::user()->id;
        $video->thumbnail=$filename;
        $video->token_id = $token_id;
        $tagArray = [];
        $tagArray = explode(',', $request->tags);
        $video->save();
        foreach($tagArray as $tag){
            $assiatant = new VideoAssistant();
            $assiatant->tag = $tag;
            $assiatant->video_id = $video->id;
            $assiatant->save();

        }
           $data = array(
                'video'    => $video,
                'status'    => 'ok',
                'status_code'    =>200,
            );
        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
        return view('admin.video-destroy', ['video'=>$video]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
        $categories = Category::select('id', 'title')->orderByDesc('created_at')->get();
        $playlists = Playlist::select('id', 'title')->orderByDesc('created_at')->get();
        $languages = Language::select('id', 'title')->orderByDesc('created_at')->get();
        return view('admin.video-edit', [
            'video'=>$video,
            'languages'=>$languages,
            'playlists'=>$playlists,
            'categories'=>$categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
        // return $request->tags;
        $token_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12);
        $file = $request->file('thumbnail');
        $destinationPath = 'image/thumbnail/';
        $originalFile = $file->getClientOriginalName();
        $filename=$token_id.$originalFile;
        $file->move($destinationPath, $filename);
        $video->title=$request->title;
        $video->description=$request->description;
        $video->playlist_id = $request->playlist;
        $video->url = $request->url1;
        $video->category_id = $request->category;
        $video->language_id=$request->language;
        $video->visibility=$request->visibility;
        $video->status=$request->status;
        $video->uid=Auth::user()->id;
        $video->thumbnail=$filename;
        $video->token_id = $token_id;
        $video->save();
        foreach($request->tags as $tag){
            $assiatant = new VideoAssistant();
            $assiatant->tag = $tag;
            $assiatant->video_id = $video->id;
            $assiatant->save();

        }
        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        $video->delete();
        $video->assistants()->delete();
        return redirect()->route('video.index');
    }
}
