<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['title', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(UserTest::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
