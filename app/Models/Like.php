<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;
     protected $fillable = [
       'user_id',
        'post_id',
        'likes',
    ];
    protected $dateFormat = 'Y-m-d';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function toArray()
    {
        $array = parent::toArray();

        $array['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
        $array['updated_at'] = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');

        return $array;
    }
}

