<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['title', 'body'];

    /**
     * Define la relación polimórfica.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->chaperone();
    }
}
