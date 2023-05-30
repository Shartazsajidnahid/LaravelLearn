<?php

namespace App\Http\Controllers;

use App\Models\Emp_info_padmaportal;
use App\Models\Designation;
use App\Models\Functional_designation;
use App\Models\system\SysLog;
use App\Models\system\SysBranch;
use App\Models\system\SysDepartment;
use App\Models\system\SysUnit;
use App\Models\system\SysUser;
use App\Models\system\SysGroup;
use App\Models\system\SysUserGroup;
use App\Models\Employee_User;
use App\Models\Employee;
use Illuminate\Http\Request;

use DB;

use App\Libraries\Helper;

class UpdateDataController extends Controller
{
    //
    public function update_data(){
// dd("done");
        $this->updateBranches();
        $this->updateDepartments();
        $this->updateUnits();
        $this->updateDesignation();
        $this->updateFuncDesignation();



        $alldata = Emp_info_padmaportal::all();

        foreach($alldata as $item){
            $data = $this->getParams($item);

            // Employees
            $empID = $this->updateEmployees($item, $data);

            // Sys_users
            $userID = $this->updateUsers($item);

            // Sys_UserGroups
            $this->updateUserGroup($userID);

            // Employee_Users
            $this->updateEmployeeUser($empID, $userID);
            // dd("done");
        }
        return redirect()->route('admin.employees.list')->with('success', 'Employee data has been updated successfully.');
        // dd("data update done");
    }

    private function getParams($item){
            // $data['branchID'] = SysBranch::where("hr_branch_id", $item->BRANCH_ID)->first()->id;
            if($item->BRANCH_NAME != NULL){
                $data['branchID'] = SysBranch::where("hr_branch_id", $item->BRANCH_ID)->first()->id;
            }
            else{
                $data['branchID'] = NULL;
            }
            if($item->DEPARTMENT_NAME != NULL){
                $data['deptID'] = SysDepartment::where("hr_department_id", $item->BR_DEPARTMENT_ID)->first()->id;
            }
            else{
                $data['deptID'] = NULL;
            }

            if($item->UNIT_NAME != NULL){
                $data['unitID'] = SysUnit::where("hr_unit_id",  $item->BR_UNIT_ID)->first()->id;
            }
            else{
                $data['unitID'] = NULL;
            }
            // $data['designationID'] = Designation::where("designation", $item->EMP_DESIGNATION)->first()->id;


            if($item->DESIGNATION_ID != NULL){
                $data['designationID'] = Designation::where("designation_id", $item->DESIGNATION_ID)->first()->id;
            }
            else{
                $data['designationID'] = NULL;
            }

            if($item->FUNCTIONAL_DESIGNATION_ID != NULL){
                $data['func_designationID'] = Functional_designation::where("func_designation_id", $item->FUNCTIONAL_DESIGNATION_ID)->first()->id;
            }
            else{
                $data['func_designationID'] = NULL;
            }

            return $data;
    }

    private function updateEmployees($item, $data){
            // Employees
            if (Employee::where('user_name', $item->EMPLOYEE_ID)->exists()) {
                $employee = Employee::where('user_name', $item->EMPLOYEE_ID)->first();
            }
            else{
                $employee = new Employee();

                $employee->user_name = $item->EMPLOYEE_ID;
                $employee->password = "12345678";
            }
            $employee->name = $item->EMP_NAME;
            $employee->division_id = $item->HEAD_OFFICE;
            $employee->branch_id = $data['branchID'];
            $employee->department_id = $data['deptID'];
            $employee->unit_id =$data['unitID'];
            $employee->designation_id = $data['designationID'];
            $employee->func_designation_id = $data['func_designationID'];

            $employee->gender = $item->GENDER;
            $employee->mobile = $item->PHONE_NO;
            $employee->dob = $item->DOB;
            $employee->email = $item->EMAIL_ID;
            $employee->joinning_date = $item->JOING_DATE;

            $employee->save();
            $empID = $employee->id;
            return $empID;
    }

    private function updateUsers($item){
        // Employees

        if (SysUser::where('username', $item->EMPLOYEE_ID)->exists()) {
            $user = SysUser::where('username', $item->EMPLOYEE_ID)->first();
        }
        else{
            $user = new SysUser();
        }

        $user->name = $item->EMP_NAME;
        $user->username = $item->EMPLOYEE_ID;
        $user->email = $item->EMAIL_ID;

        if($user->password == NULL){
            $user->password = Helper::hashing_this("12345678");
        }

        $user->save();
        $userID = $user->id;
        return $userID;
    }

    private function updateUserGroup($userID){
        // Employees
        if (SysUserGroup::where('user', $userID)->exists()) {
            // $usergroup = SysUserGroup::where('user', $userID)->first();
        }
        else{
            $usergroup = new SysUserGroup();
            $usergroup->user = $userID;
            $usergroup->group = 2;
            $usergroup->save();
        }
    }

    private function updateEmployeeUser($empID, $userID){
        // Employees
        if (Employee_User::where('user', $userID)->exists()) {
            // $usergroup = SysUserGroup::where('user', $userID)->first();
        }
        else{
            $employee_user = new Employee_User();
            $employee_user->user = $userID;
            $employee_user->employee = $empID;
            $employee_user->save();
        }
    }

    private function updateDesignation(){

        $uniqueDesignations = DB::table('emp_info_padmaportal')
            ->select('emp_info_padmaportal.EMP_DESIGNATION', 'emp_info_padmaportal.DESIGNATION_ID')
            ->groupBy('emp_info_padmaportal.EMP_DESIGNATION', 'emp_info_padmaportal.DESIGNATION_ID')
            ->where('emp_info_padmaportal.DESIGNATION_ID', '!=', null)
            ->get();

        // dd($uniqueDesignations[0]);
        foreach($uniqueDesignations as $item){

            if (Designation::where('designation_id', $item->DESIGNATION_ID)->exists()) {
                $designation = Designation::where('designation_id', $item->DESIGNATION_ID)->first();
            }
            else{
                $designation = new Designation();
                $designation->designation_id = $item->DESIGNATION_ID;
                // $designation->shortcode = ;
                // $designation->seniority_order = ;
            }
            $designation->designation = $item->EMP_DESIGNATION;
            $designation->save();
        }

    }

    private function updateFuncDesignation(){

        $uniqueFuncDesignations = DB::table('emp_info_padmaportal')
            ->select('emp_info_padmaportal.FUNCTIONAL_DESIGNATION_NAME', 'emp_info_padmaportal.FUNCTIONAL_DESIGNATION_ID')
            ->groupBy('emp_info_padmaportal.FUNCTIONAL_DESIGNATION_NAME', 'emp_info_padmaportal.FUNCTIONAL_DESIGNATION_ID')
            ->where('emp_info_padmaportal.FUNCTIONAL_DESIGNATION_ID', '!=', null)
            ->get();

        // dd($uniqueDesignations[0]);
        foreach($uniqueFuncDesignations as $item){

            if (Functional_designation::where('func_designation_id', $item->FUNCTIONAL_DESIGNATION_ID)->exists()) {
                $func_designation = Functional_designation::where('func_designation_id', $item->FUNCTIONAL_DESIGNATION_ID)->first();
            }
            else{
                $func_designation = new Functional_designation();
                $func_designation->func_designation_id = $item->FUNCTIONAL_DESIGNATION_ID;
                // $designation->shortcode = ;
                // $designation->seniority_order = ;
            }
            $func_designation->designation = $item->FUNCTIONAL_DESIGNATION_NAME;
            $func_designation->save();
        }

    }

    private function updateBranches(){

        $uniqueBranches = DB::table('emp_info_padmaportal')
        ->select('emp_info_padmaportal.BRANCH_NAME', 'emp_info_padmaportal.BRANCH_ID', 'emp_info_padmaportal.HEAD_OFFICE', 'emp_info_padmaportal.PARENT_BRANCH')
        ->groupBy('emp_info_padmaportal.BRANCH_NAME', 'emp_info_padmaportal.BRANCH_ID', 'emp_info_padmaportal.HEAD_OFFICE', 'emp_info_padmaportal.PARENT_BRANCH')
        ->where('emp_info_padmaportal.BRANCH_NAME', '!=', null)
        ->get();

        // dd($uniqueBranches);

        foreach($uniqueBranches as $item){
            if (SysBranch::where('hr_branch_id', $item->BRANCH_ID)->exists()) {
                $branch = SysBranch::where('hr_branch_id', $item->BRANCH_ID)->first();
            }
            else{
                $branch = new SysBranch();
                $branch->hr_branch_id = $item->BRANCH_ID;
                $branch->division_id = $item->HEAD_OFFICE;
            }
            $branch->name = $item->BRANCH_NAME;
            if($branch->parent_id == NULL){
                $branch->parent_id = 0;
            }
            else{
                $branch->parent_id = SysBranch::where("hr_branch_id", $item->PARENT_BRANCH)->first()->id;
            }

            $branch->status = 1;
            $branch->save();
        }

    }

    private function updateDepartments(){
        $uniqueDepartments = DB::table('emp_info_padmaportal')
        ->select('emp_info_padmaportal.DEPARTMENT_NAME', 'emp_info_padmaportal.BR_DEPARTMENT_ID', 'emp_info_padmaportal.BRANCH_ID', 'emp_info_padmaportal.BRANCH_NAME')
        ->groupBy('emp_info_padmaportal.DEPARTMENT_NAME', 'emp_info_padmaportal.BR_DEPARTMENT_ID', 'emp_info_padmaportal.BRANCH_ID','emp_info_padmaportal.BRANCH_NAME')
        ->where('emp_info_padmaportal.DEPARTMENT_NAME', '!=', null)
        ->get();

        // dd($uniqueDepartments);

        foreach($uniqueDepartments as $item){
            $branchID = SysBranch::where("hr_branch_id", $item->BRANCH_ID)->first()->id;
            // dd($branchID);
            if (SysDepartment::where('hr_department_id', $item->BR_DEPARTMENT_ID)->exists()) {
                $department = SysDepartment::where('hr_department_id', $item->BR_DEPARTMENT_ID)->first();
            }
            else{
                $department = new SysDepartment();
                $department->hr_department_id = $item->BR_DEPARTMENT_ID;
            }

            $department->name = $item->DEPARTMENT_NAME;
            $department->branch_id = $branchID;
            $department->branch_name = $item->BRANCH_NAME;
            $department->status = 1;
            $department->save();
        }
    }

    private function updateUnits(){
        $uniqueUnits = DB::table('emp_info_padmaportal')
        ->select('emp_info_padmaportal.UNIT_NAME', 'emp_info_padmaportal.BR_UNIT_ID', 'emp_info_padmaportal.BR_DEPARTMENT_ID', 'emp_info_padmaportal.DEPARTMENT_NAME')
        ->groupBy('emp_info_padmaportal.UNIT_NAME', 'emp_info_padmaportal.BR_UNIT_ID', 'emp_info_padmaportal.BR_DEPARTMENT_ID', 'emp_info_padmaportal.DEPARTMENT_NAME')
        ->where('emp_info_padmaportal.UNIT_NAME', '!=', null)
        ->get();

        // dd($uniqueDepartments);

        foreach($uniqueUnits as $item){
            $departmentID = SysDepartment::where("hr_department_id", $item->BR_DEPARTMENT_ID)->first()->id;
            // dd($branchID);
            if (SysUnit::where('hr_unit_id', $item->BR_UNIT_ID)->exists()) {
                $unit = SysUnit::where('hr_unit_id', $item->BR_UNIT_ID)->first();
            }
            else{
                $unit = new SysUnit();
                $unit->hr_unit_id = $item->BR_UNIT_ID;
            }

            $unit->name = $item->UNIT_NAME;
            $unit->department_id = $departmentID;
            $unit->department_name = $item->DEPARTMENT_NAME;
            $unit->status = 1;
            $unit->save();
        }
    }
}



