<?php
namespace App\Http\Controllers\Admin\system;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


use App\Models\system\SysDivision;
use App\Models\Designation;
use App\Models\Functional_designation;
use App\Models\system\SysLog;
use App\Models\system\SysUser;
use App\Models\system\SysGroup;
use App\Models\system\SysUserGroup;
use App\Models\Employee_User;
use App\Models\Employee;

// LIBRARIES
use App\Libraries\Helper;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employee = Employee::all();
        // dd($employee);
        return view('admin.system.employee.index', compact('employee'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = SysDivision::where('status', 1)->get();
        $designations = Designation::all();
        $func_designations = Functional_designation::all();
        return view('admin.system.employee.create', compact( 'divisions', 'designations', 'func_designations'));
    }

    public function store(Request $request)
    {
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->user_name = $request->input('user_name');

        $employee->division_id = $request->input('division_id');
        $employee->branch_id = $request->input('branch_id');
        $employee->department_id = $request->input('department_id');
        $employee->unit_id = $request->input('unit_id');

        $employee->designation_id = $request->input('designation_id');
        $employee->func_designation_id  = $request->input('func_designation_id');

        // dd($request->input('joinning_date'));
        $employee->gender= $request->input('gender');
        $employee->dob = $request->input('dob');
        $employee->mobile= $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->office_phone = $request->input('office_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password');
        $employee->joinning_date = $request->input('joinning_date');

        if($request->hasfile('profile_image'))
        {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/employees/', $filename);
            $employee->profile_image = $filename;
        }
        $employee->save();

        // SAVE THE DATA
        $data = new SysUser();
        $data->name = $employee->name;
        $data->username = $employee->user_name;
        $data->email = $employee->email;
        $data->password = Helper::hashing_this($request->input('password'));
        $data->status = 1;

        if ($data->save()) {
            // SET USERGROUP
            $group = new SysUserGroup();
            $group->user = $data->id;
            $group->group = 2;
            $group->save();

            // Employee_User
            $employee_user = new Employee_User();
            $employee_user->user = $data->id;
            $employee_user->employee = $employee->id;
            $employee_user->save();

            // LOGGING
            $log = new SysLog();
            $log->subject = Session::get('admin')->id;
            $log->action = 4;
            $log->object = $data->id;
            $log->save();
        }
        return redirect()->route('employees.index')->with('success','Employee has been created successfully.');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.system.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->user_name = $request->input('user_name');

        $employee->division_id = $request->input('division_id');
        $employee->branch_id = $request->input('branch_id');
        $employee->department_id = $request->input('department_id');
        $employee->unit_id = $request->input('unit_id');

        $employee->designation_id = $request->input('designation_id');
        $employee->func_designation_id  = $request->input('func_designation_id');

        // dd($request->input('joinning_date'));
        $employee->gender= $request->input('gender');
        $employee->dob = $request->input('dob');
        $employee->mobile= $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->office_phone = $request->input('office_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password');
        $employee->joinning_date = $request->input('joinning_date');

        if($request->hasfile('profile_image'))
        {
            $destination = 'uploads/employees/'.$employee->profile_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/employees/', $filename);
            $employee->profile_image = $filename;
        }

        // dd($id);

        $employee->update();
        return redirect()->route('employees.index')->with('success','Employee has been created successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $destination = 'uploads/employees/'.$employee->profile_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $employee->delete();
        return redirect('/')->with('completed', 'employee has been deleted');
    }
}
