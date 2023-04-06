<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applink extends Model
{
    protected $table = 'applinks';

    protected $fillable = ['name','link','image'];

}
