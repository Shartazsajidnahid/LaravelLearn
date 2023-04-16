<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopDepositor extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'top_depositors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'rank', 'created_at'
    ];

    const UPDATED_AT = null;
}
