<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'answers', 'correct_answer', 'points'];

    protected $casts = [
        'answers' => 'array'
    ];

    protected $hidden = ['correct_answer'];

    protected $appends = ['info'];

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

    public function getInfoAttribute()
    {
        return UserQuestion::whereQuestionId($this->id)->where('user_id', Auth::id())->first();
    }
}
