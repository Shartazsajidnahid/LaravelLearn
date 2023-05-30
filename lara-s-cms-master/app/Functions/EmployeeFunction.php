<?php

namespace App\Functions;

use App\Models\Employee;
use App\Models\system\SysBranch;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

/**
 * Created By
 * Pronab Kumer Roy
 * Senior Officer
 * Created on 11-Nov-2022
 *
 */
class EmployeeFunction
{
    /**
     * This will Rerun All Employee List
     * @return mixed
     */
    public static function allEmployees()
    {
        try {
            return Employee::select(DB::raw("concat(user_name, concat('-', name)) emp_name"), 'user_name')
                ->pluck('emp_name', 'user_name');
        } catch (Exception $e) {
            return redirect()->back()->with('msg-error', $e->getMessage());
        }

    }

    public static function allBranchAndDivision()
    {
        try {
            return SysBranch::select('name', 'id')
                ->pluck('name', 'id');
        } catch (Exception $e) {
            return redirect()->back()->with('msg-error', $e->getMessage());
        }
    }


    /**
     * This Function will Return a Single Employee
     * @param $employeeId
     * @return mixed
     */
    public static function singleEmployeeInfo($employeeId)
    {
        try {
            return Employee::select(DB::raw("(user_name || ' - ' || name) name"), 'user_name')
                ->where('user_name', $employeeId)
                ->pluck('name');
        } catch (Exception $e) {
            return redirect()->back()->with('msg-error', $e->getMessage());
        }

    }


}
