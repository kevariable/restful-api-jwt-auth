<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'body', 'tag_id'
    ];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
