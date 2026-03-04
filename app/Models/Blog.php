<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'short_desc',
        'image',
        'body',
        'likes',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
