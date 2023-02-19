<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynController extends Model
{
    //

    protected $table = 'dyn_controllers';

    protected $fillable = [
        'controller_name',  'created_at', 'updated_at'
    ];

}
