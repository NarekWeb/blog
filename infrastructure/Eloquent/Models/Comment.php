<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static CommentFactory factory()
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'visitor_id',
        'body',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
