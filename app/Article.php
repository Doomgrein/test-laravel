<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use League\Flysystem\Config;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['text', 'theme', 'id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Функция, проверяющая, является ли автором статьи данный пользователь
     * @param $user
     * @return bool|mixed|null
     */
    public function isAuthor($user)
    {
        if (!$user) {
            return Config::get('constants.mismatch');
        }

        if ($this->trashed()) {
            return null;
        }

        if ($this->users()->find($user->id)) {
            return true;
        } else {
            return Config::get('constants.mismatch');
        }
    }
}
