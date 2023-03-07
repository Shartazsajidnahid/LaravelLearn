<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functional_designation extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'functional_designations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'func_designation_id', 'designation', 'role_status', 'created_at', 'updated_at', 'deleted_at'
    ];
}
