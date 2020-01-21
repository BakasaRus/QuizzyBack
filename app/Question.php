<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'answers', 'correct_answer', 'points'];

    protected $casts = [
        'answers' => 'array'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function answered_users()
    {
        return $this->belongsToMany(User::class, 'user_question')
                    ->using(UserQuestion::class)
                    ->withPivot(['answer', 'is_correct']);
    }
}
