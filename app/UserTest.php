<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTest extends Pivot
{
    protected $fillable = ['score'];
}
