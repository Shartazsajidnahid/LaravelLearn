<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee_User extends Model
{
    //
    protected $table = 'employee_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee', 'user', 'created_at', 'updated_at', 'deleted_at'
    ];
}
