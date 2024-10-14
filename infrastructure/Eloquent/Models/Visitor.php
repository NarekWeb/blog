<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\VisitorFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static VisitorFactory factory()
 */
class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['uuid'];
}
