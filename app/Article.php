<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['text', 'theme', 'id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
