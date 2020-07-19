<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * Mass Assignmenable
     */
    protected $fillable = [
        'title', 'slug', 'body', 'articleable_id', 'articleable_type'
    ];

    public function articleable()
    {
        return $this->morphTo();
    }
}
