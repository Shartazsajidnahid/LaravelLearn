<?php

namespace App\Http\Controllers\Admin\system;

// composer require maatwebsite/excel


use App\Functions\EmployeeFunction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\system\SysDivision;
use App\Models\Designation;
use App\Models\Functional_designation;
use App\Models\system\SysLog;
use App\Models\system\SysBranch;
use App\Models\system\SysUser;
use App\Models\system\SysGroup;
use App\Models\system\SysUserGroup;
use App\Models\Employee_User;
use App\Models\Employee;

// LIBRARIES
use App\Libraries\Helper;
use mysql_xdevapi\Exception;
use Yajra\DataTables\DataTables;


class EmployeeController extends Controller
{
    public function oneRecordwith_names($value)
    {
        $newarr = array('id' => $value->id, 'name' => $value->name, 'user_name' => $value->user_name, 'division_id' => $value->division_id,
            'branch_id' => $value->branch_id, 'department_id' => $value->department_id, 'unit_id' => $value->unit_id,
            'designation_id' => $value->designation_id, 'func_designation_id' => $value->func_designation_id, 'gender' => $value->gender, 'mobile' => $value->mobile,
            'pabx_phone' => $value->pabx_phone, 'dob' => $value->dob, 'email' => $value->email, 'office_phone' => $value->office_phone,
            'ip_phone' => $value->ip_phone, 'password' => $value->password, 'profile_image' => $value->profile_image, 'joinning_date' => $value->joinning_date,
            'created_at' => $value->created_at, 'updated_at' => $value->updated_at);

        $destination = Designation::where('id', $value->designation_id)->pluck('designation');
        $func_destination = Functional_designation::where('id', $value->func_designation_id)->pluck('designation');

        $newarr['destination'] = $destination[0];
        if (sizeof($func_destination)) {
            $newarr['func_destination'] = $func_destination[0];
        } else {
            $newarr['func_destination'] = "";
        }
        return $newarr;
    }

    public function getDatawithNames($data)
    {
        $newdata = array();
        foreach ($data as $value) {
            $newarr = $this->oneRecordwith_names($value);
            $newdata[] = $newarr;
        }
        // dd($newdata);
        return $newdata;

    }

    public function index(Request $request)
    {
        $data['employee'] = $this->filterResult($request);
        $data['employeeList'] = EmployeeFunction::allEmployees();
        $data['branchDivisionList'] = EmployeeFunction::allBranchAndDivision();
        return view('admin.system.employee.index', compact('data'));
    }
    public function downloadEmployees(Request $request)
    {

        $employeeData = Session::get('lastSearchResult');
        // dd($employeeData);
        // Create a new instance of the Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Employee ID');
        $sheet->setCellValue('C1', 'Branch/Division');
        $sheet->setCellValue('D1', 'Department');
        $sheet->setCellValue('E1', 'Unit');
        $sheet->setCellValue('F1', 'Designation');
        $sheet->setCellValue('G1', 'Functional Designation');
        $sheet->setCellValue('H1', 'Mobile');
        $sheet->setCellValue('I1', 'Email');

        // Populate the data starting from row 2
        $row = 2;
        foreach ($employeeData[0] as $employee) {
         $sheet->setCellValue('A' . $row, $employee->name);
        $sheet->setCellValue('B' . $row, $employee->user_name);
        $sheet->setCellValue('C' . $row, $employee->branch?$employee->branch->name:"-");
        $sheet->setCellValue('D' . $row, $employee->department?$employee->department->name:"-");
        $sheet->setCellValue('E' . $row, $employee->unit?$employee->unit->name:"-");
        $sheet->setCellValue('F' . $row, $employee->designation?$employee->designation->designation:"-");
        $sheet->setCellValue('G' . $row, $employee->funcDesignation?$employee->funcDesignation->designation:"-");
        $sheet->setCellValue('H' . $row, $employee->mobile);
        $sheet->setCellValue('I' . $row, $employee->email);


            $row++;
        }

        // Create a new instance of the Xlsx writer
        $writer = new Xlsx($spreadsheet);

        // Generate a stream response with the Excel file
        $response = new StreamedResponse(function () use ($writer) {
            // Set the appropriate headers for Excel download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="employee_info.xlsx"');

            // Save the spreadsheet to the output stream
            $writer->save('php://output');
        });

        // Return the response
        return $response;
    }



    private function filterResult($request)
    {
        $filterData = Employee::query();

        if ($request->filled('user_name')) {
            $filterData->where('user_name', $request->user_name);
        }
        if ($request->filled('branch_id')) {
            $filterData->where('branch_id', $request->branch_id);
        }
        if (Session::has('lastSearchResult')) {
            Session::forget('lastSearchResult');
        }

        Session::push('lastSearchResult', $filterData->get());
        return $filterData->paginate(10);
    }


    public function getCHOemployee(Request $request){
        // // AUTHORIZING...
        // $authorize = Helper::authorizing($this->module, 'View List');
        // if ($authorize['status'] != 'true') {
        //     return response()->json([
        //         'status' => 'false',
        //         'message' => $authorize['message']
        //     ]);
        // }

        $user_name= $request->post('user_name');

        $data = Employee::select(
            'employees.*',
            'designations.designation as designation',
            'functional_designations.designation as functional_designation',
        )
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->leftJoin('functional_designations', 'employees.func_designation_id', '=', 'functional_designations.id')
            ->where('user_name', '=', $user_name)
            ->first();


        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Successfully get data list',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function getData(Datatables $datatables)
    {
        $employee = Employee::get();
        return $datatables->eloquent($employee)
            ->toJson();
    }

    public function create()
    {
        $divisions = SysDivision::where('status', 1)->get();
        $designations = Designation::all();
        $func_designations = Functional_designation::all();
        return view('admin.system.employee.create', compact('divisions', 'designations', 'func_designations'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'branch_id' => 'required',
            'user_name' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
        ]);
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->user_name = $request->input('user_name');

        $employee->division_id = $request->input('division_id');
        $employee->branch_id = $request->input('branch_id');
        $employee->department_id = $request->input('department_id');
        if ($employee->department_id == 'choose one') {
            $employee->department_id = null;
        }
        $employee->unit_id = $request->input('unit_id');

        $employee->designation_id = $request->input('designation_id');

        $employee->func_designation_id = $request->input('func_designation_id');
        if ($employee->func_designation_id == 'null') {
            $employee->func_designation_id = null;
        }
        if ($request->input('gender') == 1) {
            $employee->gender = "Male";
        } else {
            $employee->gender = "Female";
        }

        $employee->dob = $request->input('dob');
        $employee->mobile = $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->office_phone = $request->input('office_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');
        if($request->input('email')==null){
            $employee->email = "";
        }
        else{
            $employee->email = $request->input('email');
        }

        if($request->input('password')==null){
            $password = "12345678";
        }
        else{
            $password = $request->input('password');
        }


        $employee->password = Helper::hashing_this($password);

        $empJoiningDate = date('Y-m-d', strtotime(str_replace('/', '-', $request->joinning_date)));
        $employee->joinning_date = $empJoiningDate;

        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/employees/' . $employee->user_name . '/', $filename);
            $employee->profile_image = $filename;
        } else {
            $employee->profile_image = "";
        }
        // dd($employee);
        try {
            if ($employee->save()) {
                // SAVE THE DATA
                $data = new SysUser();
                $data->name = $employee->name;
                $data->username = $employee->user_name;
                $data->email = $employee->email;
                $data->password = Helper::hashing_this($password);
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
                    return redirect()->route('admin.employees.list')->with('success', 'Employee has been created successfully.');

                }
            }

        } catch (QueryException $e) {
            // dd($e);
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
        $branches = SysBranch::where('status', 1)->get();
        $designations = Designation::all();
        $func_designations = Functional_designation::all();
        $employee = Employee::findOrFail($id);
        return view('admin.system.employee.edit', compact('employee', 'divisions', 'branches', 'designations', 'func_designations'));
    }

    public function update(Request $request, $id)
    {

        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->user_name = $request->input('user_name');

        $employee->division_id = $request->input('division_id');
        $employee->branch_id = $request->input('branch_id');
        if ($employee->department_id == 'choose one') {
            $employee->department_id = null;
        }
        if ($employee->unit_id == 'choose one') {
            $employee->unit_id = null;
        }
        $employee->designation_id = $request->input('designation_id');
        $employee->func_designation_id = $request->input('func_designation_id');

        if ($request->input('gender') == 1) {
            $employee->gender = "Male";
        } else {
            $employee->gender = "Female";
        }
        $employee->dob = $request->input('dob');
        $employee->mobile = $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->office_phone = $request->input('office_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');
        if($request->input('password')==null){
            $password = "12345678";
        }
        else{
            $password = $request->input('password');
        }
        $employee->password = Helper::hashing_this($password);

        $employee->joinning_date = $request->input('joinning_date');

        if ($request->hasfile('profile_image')) {
            $destination = 'uploads/employees/' . $employee->user_name . $employee->profile_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/employees/' . $employee->user_name . '/', $filename);
            $employee->profile_image = $filename;
        }

        try {
            if ($employee->update()) {
                // SAVE THE DATA

                $employee_user = Employee_User::where('employee', $employee->id)->first();
                $data = SysUser::where('id', $employee_user->user)->first();
                // $data =SysUser::find();
                $data->name = $employee->name;
                $data->username = $employee->user_name;
                $data->email = $employee->email;
                $data->password = Helper::hashing_this($password);
                $data->status = 1;

                if ($data->save()) {
                    return redirect()->route('admin.employees.list')->with('success', 'Employee has been created successfully.');

                }
            }

        } catch (QueryException $e) {
            // dd($e);
            // FAILED
            return back()
                ->withInput()
                ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => "Employee"]));

        }



    }

    public function update_info(Request $request, $id)
    {


        $employee = Employee::findOrFail($id);
        $employee->mobile = $request->input('mobile');
        $employee->pabx_phone = $request->input('pabx_phone');
        $employee->ip_phone = $request->input('ip_phone');
        $employee->email = $request->input('email');

        try {
            if ($employee->update()) {
                return back();
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
        $destination = 'uploads/employees/' . $employee->profile_image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $employee->delete();
        return redirect()->route('admin.employees.list')->with('success', 'Employee has been deleted successfully.');
    }

    public function updateEmployees()
    {
        $allEmployees = Employee::get();
        foreach ($allEmployees as $employee) {
            $employeeId = $employee->user_name;
            try {
                DB::select("call SP_update_emp_info('$employeeId')");
            } catch (Exception $e) {
                dd($e);
            }

        }
    }


}
