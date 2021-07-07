<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'title',
        'description',
        'thumbnail',
    ];
    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id');
    }
}
