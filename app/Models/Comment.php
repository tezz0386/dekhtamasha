<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'uid',
        'video_id',
        'comment'
    ];
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
