<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class functions extends Model
{
    //
    protected $table = 'functions';

    protected $fillable = [
        'function_name', 'type', 'controller_id',  'created_at', 'updated_at'
    ];


}
