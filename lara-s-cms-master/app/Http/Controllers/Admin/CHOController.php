<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\QueryException;

use Yajra\Datatables\Datatables;
use App\Models\CHO;
use App\Models\system\SysBranch;
use App\Models\Employee;


use App\Functions\EmployeeFunction;
// LIBRARIES
use App\Libraries\Helper;


class CHOController extends Controller
{
    // SET THIS MODULE
    private $module = 'CHO';
    // SET THIS OBJECT/ITEM NAME
    private $item = 'cho';

    public function index()
    {
    // AUTHORIZING...
    $authorize = Helper::authorizing($this->module, 'View List');
    if ($authorize['status'] != 'true') {
        return back()->with('error', $authorize['message']);
    }


        $cho = CHO::select(
            'cho.id',
            'cho.position',
            'employees.name as name',

        )
            ->leftJoin('employees', 'cho.user_id', '=', 'employees.user_name')
            ->orderBy('cho.position')
            ->get();
        // dd($applink);
        return view('admin.cho.index', compact('cho'));
    }

    public function create(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        $data['employee'] = $this->filterResult($request);
        $data['employeeList'] = EmployeeFunction::allEmployees();

        $branches = SysBranch::all();
        return view('admin.cho.create', compact('branches', 'data'));
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
        return $filterData->paginate(10);
    }

    public function store(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        $selected = $request->input('selected');
        $jsonD = json_encode($selected);

        $cho = new CHO;
        $cho->user_id =  $request->input('user_name');
        $cho->position =  (int) $request->input('position');
        $cho->branches = $jsonD;

        // dd($cho);

        try {
            if( $cho->save() ){
            // SUCCESS
            return redirect()->route('admin.cho.list')->with('success','cho has been created successfully.');
            }
       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));
       }
    }


    public function edit($id, Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View Details');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        // $cho = CHO::findOrFail($id);

        $cho = CHO::select(
            'cho.id',
            'cho.user_id',
            'cho.position',
            'cho.branches',
            'employees.name as name',
            'employees.email as email',
            'designations.designation as designation',
            'functional_designations.designation as functional_designation'

        )
            ->leftJoin('employees', 'cho.user_id', '=', 'employees.user_name')
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->leftJoin('functional_designations', 'employees.func_designation_id', '=', 'functional_designations.id')
            ->where('cho.id', $id)
            ->first();

        // dd($cho);

        $selected = $cho->branches;
        $jsonBranch = json_decode($selected);
        // dd($jsonBranch);

        $data['employee'] = $this->filterResult($request);
        $data['employeeList'] = EmployeeFunction::allEmployees();

        $branches = SysBranch::all();
        return view('admin.cho.edit', compact('cho', 'branches', 'jsonBranch', 'data'));
    }

    public function update($id, Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Edit');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $selected = $request->input('selected');
        $jsonD = json_encode($selected);

        $cho = CHO::findOrFail($id);
        $cho->user_id =  $request->input('user_name');
        $cho->position =  (int) $request->input('position');
        $cho->branches = $jsonD;


        try {
            if( $cho->update() ){
            // SUCCESS
            return redirect()->route('admin.cho.list')->with('success','cho has been created successfully.');
            }
       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));

       }
    }


    public function destroy($id)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Delete');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $cho = CHO::findOrFail($id);

        $cho->delete();
        return redirect()->route('admin.cho.list')->with('success','cho has been deleted successfully.');
    }

}
