<?php
namespace App\Models\system;

use Illuminate\Database\Eloquent\Model;

class Division_admin extends Model
{
    //
    protected $table = 'division_admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'division_id', 'branch_id', 'department_id', 'unit_id', 'assign_to', 'created_at', 'updated_at', 'deleted_at'
    ];
}
