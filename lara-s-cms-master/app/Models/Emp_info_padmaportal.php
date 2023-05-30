<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emp_info_padmaportal extends Model
{
    //

    protected $table = 'emp_info_padmaportal';

    protected $fillable = ['EMP_NAME', 'EMPLOYEE_ID', 'EMP_DESIGNATION', 'DESIGNATION_ID', 'FUNCTIONAL_DESIGNATION_NAME', 'FUNCTIONAL_DESIGNATION_ID',
'OFFICE', 'HEAD_OFFICE', 'PARENT_BRANCH','BRANCH_NAME', 'DEPARTMENT_NAME', 'BR_DEPARTMENT_ID', 'UNIT_NAME', 'BR_UNIT_ID', 'GENDER', 'DOB', 'PHONE_NO', 'EMAIL_ID', 'JOING_DATE'];

}










