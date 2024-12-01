<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'name',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
