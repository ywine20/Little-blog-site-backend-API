<?php

namespace App\Models;

use App\Models\PostImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'description',
      'like_count',
    ];

    public function comments()
{
    return $this->hasMany(Comment::class);
}

   public function images()
{
    return $this->hasMany(PostImage::class);
}
  public function likes()
    {
        return $this->hasMany(Like::class);
    }


}
