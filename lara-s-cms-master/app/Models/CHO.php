<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CHO extends Model
{
    //
    protected $table = 'cho';

    protected $fillable = ['name','mobile','email', 'designation', 'branches', 'profile_image', ];
}
