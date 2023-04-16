<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Yajra\Datatables\Datatables;
use App\Models\Employee;
use App\Models\system\SysBranch;
use App\Models\TopDepositor;
use App\Models\ArchiveTopDepositor;

class TopDepositorController extends Controller
{

    public function getTopDepositorWithName($employees){
        $data = array();
        foreach( $employees as $value ) {
            if($oneEmployee = Employee::find($value->employee_id)){
                $data[] = $this->oneRecordwith_Rank($oneEmployee, $value);
            }
        }
        return $data;
    }

    private function oneRecordwith_Rank($value, $top_branch){
        $newarr = array('id'=>$value->id, 'rank'=> $top_branch->rank, 'name' =>$value->name, 'user_name' =>$value->user_name, 'created_at' => $top_branch->created_at);
        return $newarr;
    }

    public function getTopBranchWithName($branches){
        $data = array();
        foreach( $branches as $value ) {
            if($oneBranch = Employee::find($value->employee_id)){
                $data[] = $this->oneRecordwith_Rank($oneBranch, $value);
            }
        }
        return $data;
    }

    public function index()
    {
        $employees = TopDepositor::all();
        $data =$this->getTopBranchWithName( $employees);
        // dd($data);
        return view('admin.top_depositor.list', compact('data'));
    }

    public function create()
    {

        //TODO: have to send only branch
        $data = Employee::all();
        $employees = $this->branch_with_null($data);
        return view('admin.top_depositor.form', compact('employees'));
    }

    private function oneRecordwith_branchName($value){
        $newarr = array('id'=>$value->id, 'status'=> 1, 'name' =>$value->name, 'user_name' =>$value->user_name, 'created_at' => $value->created_at);
        return $newarr;
    }

    public function branch_with_null($data){
        $newdata = array();
        foreach( $data as $value ) {
            $newarr = $this->oneRecordwith_branchName($value);
            $newdata[] = $newarr;
        }
        // dd($newdata);
        return $newdata;
    }

    private function saveRecord($employee_id, $rank, $created_at, $table_name){

        if($created_at != null){
            if(!$table_name::insert([
                'rank'=> $rank,
                'employee_id' => $employee_id,
                'created_at' => $created_at
            ])){
                return false;
            }
        }
        else{
            $table_name::insert([
            'rank'=> $rank,
            'employee_id' => $employee_id
        ]);
        }
        return true;

    }

    private function saveAllRecords($data, $table_name){
        $index = 0;
        foreach($data as $key => $value) {
            ++$index;
            if(!$this->saveRecord((int)$value, $index, null,  $table_name)){
                return false;
            };
        }
        return true;
    }

    public function store(Request $request)
    {
        // LARAVEL VALIDATION
        $validation = [
            'depositor_1' => 'required|not_in:0',
            'depositor_2' => 'required|not_in:0',
            'depositor_3' => 'required|not_in:0',
            'depositor_4' => 'required|not_in:0',
            'depositor_5' => 'required|not_in:0',
            'depositor_6' => 'required|not_in:0',
            'depositor_7' => 'required|not_in:0',
            'depositor_8' => 'required|not_in:0',
            'depositor_9' => 'required|not_in:0',
            'depositor_10' => 'required|not_in:0',
        ];
        $message = [
            'required' => ':attribute ' . lang('field is required', $this->translation),
            'not_in:0' => ':attribute ' . lang('field is required', $this->translation),
            'unique' => ':attribute ' . lang('has already been taken, please input another data', $this->translation)
        ];
        $names = [
            'depositor_1' => ucwords(lang('depositor_1', $this->translation)),
            'depositor_2' => ucwords(lang('depositor_2', $this->translation)),
            'depositor_3' => ucwords(lang('depositor_3', $this->translation)),
            'depositor_4' => ucwords(lang('depositor_4', $this->translation)),
            'depositor_5' => ucwords(lang('depositor_5', $this->translation)),
            'depositor_6' => ucwords(lang('depositor_6', $this->translation)),
            'depositor_7' => ucwords(lang('depositor_7', $this->translation)),
            'depositor_8' => ucwords(lang('depositor_8', $this->translation)),
            'depositor_9' => ucwords(lang('depositor_9', $this->translation)),
            'depositor_10' => ucwords(lang('depositor_10', $this->translation)),
        ];
        // $this->validate($request, $validation, $message, $names);

        $data = $request->all();
        array_splice($data, 0, 1);
        $unique = array_unique($data);
        // if ( count($data) != count($unique) ) {
        //     return back()
        //         ->withInput()
        //         ->with('error', lang('all selected branches must be unique', $this->translation, ['#item' => ucwords(lang('department', $this->translation))]));
        // }

        $top_depositor = TopDepositor::all();

        if(!$top_depositor->isEmpty()){
            foreach($top_depositor as $employees){
                if(!$this->saveRecord($employees->employee_id, $employees->rank, $employees->created_at, 'App\Models\ArchiveTopDepositor')){
                    return back()
                    ->withInput()
                    ->with('error', lang('Oops, failed to set #item. Please try again.', $this->translation, ['#item' => 'Top Depositor']));
                }
            }
            TopDepositor::truncate();
        }

        if($this->saveAllRecords($data, 'App\Models\TopDepositor')){
            return redirect()
            ->route('admin.top_depositor.list')
            ->with('success', lang('Successfully set #item', $this->translation, ['#item' => 'Top Depositor']));
        }

        // FAILED
        return back()
            ->withInput()
            ->with('error', lang('Oops, failed to set #item. Please try again.', $this->translation, ['#item' => 'Top Depositor']));
    }
}


