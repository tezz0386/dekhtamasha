<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Index;
use App\Models\LikeAssistant;
use App\Models\Playlist;
use App\Models\Trace;
use App\Models\Video;
use Auth;
use Illuminate\Http\Request;
class IndexController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::where('status', 1)->where('visibility', 1)->orderByDesc('created_at')->paginate(50);
        return view('index', ['videos'=>$videos, 'playlists'=>$this->getPlaylists(), 'categories'=>$this->getCategories()]);
    }
    public function getPlaylists()
    {
        return Playlist::select('id', 'title')->get();
    }
    public function getCategories()
    {
        return Category::select('id', 'title')->limit(3)->get();
    }


    // to get play now
    public function getWatch($token_id)
    {
        $video = Video::where('token_id', $token_id)->first();
        $playlistVideos=Video::where('playlist_id', $video->playlist_id)->limit(10)->get();
        $trace = Trace::where('video_id', $video->id)->where('client_ip', \Request::getClientIp())->first();
        // return $video->comments;
        $comments = Comment::where('video_id', $video->id)->orderByDesc('created_at')->get();
        // dd($comments);
        if(!$trace){
            $trace = new Trace();
            $trace->client_ip = \Request::getClientIp();
            $trace->video_id = $video->id;
            $video->traces()->save($trace);
            $video->increment('views');
        }
        return view('watch', ['video'=>$video, 'comments'=>$comments, 'playlistVideos'=>$playlistVideos, 'playlists'=>$this->getPlaylists(), 'categories'=>$this->getCategories()]);
    }
    public function like(Request $request){
        $likeOutput = '';
        $dislikeOutput='';
        $like = LikeAssistant::where('video_id', $request->video_id)->where('uid', Auth::user()->id)->first();
        $dislike = Dislike::where('video_id', $request->video_id)->where('uid', Auth::user()->id)->first();
        $video = Video::find($request->video_id);
        // return $dislike;
        if(!$like){
            if($dislike){
                // return "true";
                $dislike->delete();
                $video->decrement('dislike');
                $dislikeOutput = '<a href="#" id="dislike"><i class="fas fa-heart-broken" ></i>
            </a>
            <label id="like-text">'.$video->dislike.'</label>';

            }
            // return "false";
            $like = new LikeAssistant();
            $like->video_id=$request->video_id;
            $like->uid=Auth::user()->id;
            $like->save();
            $video->increment('like');
            $likeOutput= '<a href="#" id="like" class="like"><i class="fas fa-heart" ></i>
            </a>
            <label id="like-text">'.$video->like.'</label>';
            $dislikeOutput = '<a href="#" id="dislike"><i class="fas fa-heart-broken" ></i>
            </a>
            <label id="like-text">'.$video->dislike.'</label>';
        }else{
            $like->delete();
            $video->decrement('like');
            $likeOutput= '<a href="#" id="like"><i class="fas fa-heart" ></i>
            </a>
            <label id="like-text">'.$video->like.'</label>';
            $dislikeOutput = '<a href="#" id="dislike"><i class="fas fa-heart-broken" ></i>
            </a>
            <label id="like-text">'.$video->dislike.'</label>';
        }
       $data = array(
                'likeOutput'    => $likeOutput,
                'dislikeOutput' =>$dislikeOutput,
                'status'    => 'ok',
                'status_code'    =>200,
            );
        echo json_encode($data);
    }




      public function dislike(Request $request){
        $likeOutput = '';
        $dislikeOutput='';
        $like = LikeAssistant::where('video_id', $request->video_id)->where('uid', Auth::user()->id)->first();
        $dislike = Dislike::where('video_id', $request->video_id)->where('uid', Auth::user()->id)->first();
        $video = Video::find($request->video_id);
        // return $dislike;
        if(!$dislike){
            if($like){
                // return "true";
                $like->delete();
                $video->decrement('like');
                $likeOutput = '<a href="#" id="dislike"><i class="fas fa-heart" ></i>
            </a>
            <label id="like-text">'.$video->like.'</label>';

            }
            // return "false";
            $dislike = new Dislike();
            $dislike->video_id=$request->video_id;
            $dislike->uid=Auth::user()->id;
            $dislike->save();
            $video->increment('dislike');
            $likeOutput= '<a href="#" id="like"><i class="fas fa-heart" ></i>
            </a>
            <label id="like-text">'.$video->like.'</label>';
            $dislikeOutput = '<a href="#" id="dislike" class="like"><i class="fas fa-heart-broken" ></i>
            </a>
            <label id="like-text">'.$video->dislike.'</label>';
        }else{
            $dislike->delete();
            $video->decrement('dislike');
            $likeOutput= '<a href="#" id="like"><i class="fas fa-heart"></i>
            </a>
            <label id="like-text">'.$video->like.'</label>';
            $dislikeOutput = '<a href="#" id="dislike"><i class="fas fa-heart-broken" ></i>
            </a>
            <label id="like-text">'.$video->dislike.'</label>';
        }
       $data = array(
                'likeOutput'    => $likeOutput,
                'dislikeOutput' =>$dislikeOutput,
                'status'    => 'ok',
                'status_code'    =>200,
            );
        echo json_encode($data);
    }


    public function getVideoWithCategory($id)
    {
        $category = Category::find($id);
        if($category !=null){
        return view('index', ['videos'=>$category->videos, 'title'=>'Dekhtamasha-movies', 'playlists'=>$this->getPlaylists(), 'categories'=>$this->getCategories()]);
        }
        return back();
    }
    public function getVideoWithPlaylist($id)
    {
        $playlist = Playlist::find($id);
        if($playlist !=null){
        return view('index', ['videos'=>$playlist->videos, 'title'=>'Dekhtamasha-movies', 'playlists'=>$this->getPlaylists(), 'categories'=>$this->getCategories()]);
        }
        return back();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function show(Index $index)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function edit(Index $index)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Index $index)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function destroy(Index $index)
    {
        //
    }
}
