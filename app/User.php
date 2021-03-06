<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function authored_tests()
    {
        return $this->hasMany(Test::class, 'author_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'user_test')
                    ->using(UserTest::class)
                    ->withPivot(['score']);
    }

    public function answers()
    {
        return $this->belongsToMany(Question::class, 'user_question')
                    ->using(UserQuestion::class)
                    ->withPivot(['answer', 'is_correct']);
    }
}
