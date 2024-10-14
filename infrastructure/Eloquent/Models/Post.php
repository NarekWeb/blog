<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static PostFactory factory()
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'visitor_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
