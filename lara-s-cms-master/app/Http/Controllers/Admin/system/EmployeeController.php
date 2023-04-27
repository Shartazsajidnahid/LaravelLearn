<?php
namespace App\Http\Controllers\Admin\system;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;


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
    public function oneRecordwith_names($value){
        $newarr = array('id'=>$value->id, 'name' =>$value->name, 'user_name' =>$value->user_name , 'division_id'=> $value->division_id,
        'branch_id'=> $value->branch_id, 'department_id'=> $value->department_id, 'unit_id'=> $value->unit_id,
        'designation_id'=>$value->designation_id  , 'func_designation_id'=>$value->func_designation_id , 'gender'=>$value->gender, 'mobile'=>$value->mobile ,
        'pabx_phone'=>$value->pabx_phone, 'dob'=>$value->dob , 'email'=>$value->email, 'office_phone'=>$value->office_phone ,
        'ip_phone'=>$value->ip_phone  , 'password'=>$value->password , 'profile_image'=>$value->profile_image, 'joinning_date'=>$value->joinning_date ,
        'created_at'=>$value->created_at, 'updated_at'=>$value->updated_at);

        $destination = Designation::where('id', $value->designation_id)->pluck('designation');
        $func_destination = Functional_designation::where('id', $value->func_designation_id)->pluck('designation');

        // $branch = Designation::find($value->designation_id);
        // $branch = Functional_designation::find($value->func_designation_id);

        $newarr['destination'] = $destination[0];
        $newarr['func_destination'] = $func_destination[0];
        // dd($newarr);
        return $newarr;
    }

    public function getDatawithNames($data){
        $newdata = array();
        foreach( $data as $value ) {
            $newarr = $this->oneRecordwith_names($value);
            $newdata[] = $newarr;
        }
        // dd($newdata);
        return $newdata;

    }

    public function index()
    {

        $data = Employee::all();
        $employee = $this->getDatawithNames($data);
        // dd($employee);
        return view('admin.system.employee.index', compact('employee'));
    }

    public function create()
    {
        $divisions = SysDivision::where('status', 1)->get();
        $designations = Designation::all();
        $func_designations = Functional_designation::all();
        return view('admin.system.employee.create', compact( 'divisions', 'designations', 'func_designations'));
    }

    public function store(Request $request)
    {
        // dd( $request->input('unit_id'));
        $request->validate([

            'branch_id' => 'required' ,
            'user_name' => 'required' ,
            'name' => 'required' ,
            'designation_id' => 'required' ,
        ]);
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->user_name = $request->input('user_name');

        $employee->division_id = $request->input('division_id');
        $employee->branch_id = $request->input('branch_id');
        $employee->department_id = $request->input('department_id');
        $employee->unit_id = $request->input('unit_id');

        $employee->designation_id = $request->input('designation_id');
        $employee->func_designation_id  = $request->input('func_designation_id');
        if($request->input('gender')==1){
            $employee->gender= "Male";
        }
        else{
            $employee->gender= "Female";
        }

        $employee->dob = $request->input('dob');
        $employee->mobile= $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->office_phone = $request->input('office_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');
        $employee->password = Helper::hashing_this($request->input('password'));
        $employee->joinning_date = $request->input('joinning_date');

        if($request->hasfile('profile_image'))
        {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/employees/', $filename);
            $employee->profile_image = $filename;
        }
        try {
            if(!$employee->save()){

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
                    return redirect()->route('employees.index')->with('success','Employee has been created successfully.');

                }
            }

       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => "Employee"]));

       }




    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $divisions = SysDivision::where('status', 1)->get();
        $designations = Designation::all();
        $func_designations = Functional_designation::all();
        $employee = Employee::findOrFail($id);
        return view('admin.system.employee.edit', compact('employee', 'divisions', 'designations', 'func_designations'));
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
        try {
            if( $employee->update()){
                return redirect()->route('employees.index')->with('success','Employee has been created successfully.');
            }

       } catch (QueryException $e) {
            // FAILED
            return back()
            ->withInput()
            ->with('error', lang('#item could not be updated', $this->translation, ['#item' => "Employee"]));

       }


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
