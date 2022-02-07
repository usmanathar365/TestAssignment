<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=[
        'rack_id',
        'title',
        'author',
        'published_year',
    ];
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
