<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Dislike;
use App\Models\LikeAssistant;
use App\Models\Trace;
use App\Models\VideoAssistant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'title',
        'category_id',
        'playlist_id',
        'thumbnail',
        'views',
        'description',
        'like',
        'dislike',
        'uid',
        'language_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function assistants()
    {
        return $this->hasMany(VideoAssistant::class, 'video_id');
    }
    public function traces()
    {
        return $this->hasMany(Trace::class, 'video_id');
    }
    public function likes()
    {
        return $this->hasMany(LikeAssistant::class, 'video_id');
    }
    public function dislikes()
    {
        return $this->hasMany(Dislike::class, 'video_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

}
