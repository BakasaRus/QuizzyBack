<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['title', 'description'];

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
}
