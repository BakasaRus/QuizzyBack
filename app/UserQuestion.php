<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserQuestion extends Pivot
{
    protected $fillable = ['answer', 'is_correct'];

    protected $casts = [
        'is_correct' => 'boolean'
    ];
}
