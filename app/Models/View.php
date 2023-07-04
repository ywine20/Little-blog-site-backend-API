<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class View extends Model
{
    protected $fillable = [
        'post_id',
        'visitor',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
