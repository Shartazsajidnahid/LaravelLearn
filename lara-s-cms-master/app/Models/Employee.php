<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name','user_name', 'division_id', 'branch_id', 'department_id', 'unit_id','designation_id','func_designation_id','gender','mobile','pabx_phone','dob' ,'email', 'office_phone','ip_phone' ,'password','profile_image', 'joinning_date'];
}
