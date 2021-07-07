<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trace extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'client_ip',
        'video_id',
        'session_id',
    ];
    protected $hidden=[
        'video_id',
        'session_id',
    ];
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
