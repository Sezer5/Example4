<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $fillable = ['title', 'thumbnail'];

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }
}
