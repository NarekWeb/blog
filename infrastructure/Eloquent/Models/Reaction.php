<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\ReactionFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static ReactionFactory factory()
 */
class Reaction extends Model
{
    use HasFactory;

    const string TYPE_LIKE = 'like';
    const string TYPE_DISLIKE = 'dislike';

    // Array of all reaction types
    public static function types()
    {
        return [
            self::TYPE_LIKE,
            self::TYPE_DISLIKE,
        ];
    }

    protected $fillable = [
        'comment_id',
        'visitor_id',
        'reaction_type'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
