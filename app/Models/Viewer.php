<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
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
