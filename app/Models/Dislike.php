<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Dislike extends Model
{
    use HasFactory;
    protected $fillable=[
            'video_id',
            'uid',
    ];
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_id');
    }
}
