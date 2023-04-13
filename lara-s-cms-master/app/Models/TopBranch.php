<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopBranch extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'top_branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'rank', 'created_at'
    ];

    const UPDATED_AT = null;
}
