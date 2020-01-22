<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Test extends Model
{
    protected $fillable = ['title', 'description'];

    protected $appends = ['info'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_test')
                    ->using(UserTest::class)
                    ->withPivot(['score']);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getInfoAttribute()
    {
        return UserTest::whereTestId($this->id)->where('user_id', Auth::id())->first();
    }
}
