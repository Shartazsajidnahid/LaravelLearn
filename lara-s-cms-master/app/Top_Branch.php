<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top_Branch extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'top__branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'rank', 'created_at', 'updated_at', 'deleted_at'
    ];
}
