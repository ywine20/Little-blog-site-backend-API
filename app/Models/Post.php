<?php

namespace App\Models;

use App\Models\View;
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
      'view_count',
    ];
 protected $dateFormat = 'Y-m-d';

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
    public function views()
    {
        return $this->hasMany(View::class);
    }

public function toArray()
    {
        $array = parent::toArray();

        $array['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
        $array['updated_at'] = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');

        return $array;
    }
}
