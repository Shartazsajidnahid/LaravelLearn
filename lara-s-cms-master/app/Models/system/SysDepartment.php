<?php

namespace App\Models\system;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SysDepartment extends Model
{
    //

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'name', 'location', 'phone', 'status', 'ordinal', 'created_at', 'updated_at', 'deleted_at'
    ];
}
