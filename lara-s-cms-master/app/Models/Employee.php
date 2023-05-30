<?php

namespace App\Models;

use App\Models\system\SysBranch;
use App\Models\system\SysDepartment;
use App\Models\system\SysDivision;
use App\Models\system\SysUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Employee extends Model
{

    protected $table = 'employees';

    protected $fillable = ['name', 'user_name', 'division_id', 'branch_id', 'department_id', 'unit_id', 'designation_id', 'func_designation_id', 'gender', 'mobile', 'pabx_phone', 'dob', 'email', 'office_phone', 'ip_phone', 'password', 'profile_image', 'joinning_date'];

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function funcDesignation(): BelongsTo
    {
        return $this->belongsTo(Functional_designation::class, 'func_designation_id', 'id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(SysDivision::class, 'division_id', 'id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(SysBranch::class, 'branch_id', 'id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(SysDepartment::class, 'department_id', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(SysUnit::class, 'unit_id', 'id');
    }


}


