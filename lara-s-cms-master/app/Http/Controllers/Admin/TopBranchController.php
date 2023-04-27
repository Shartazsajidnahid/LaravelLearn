<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Yajra\Datatables\Datatables;
use App\Models\Exchange_rate;
use App\Models\system\SysBranch;
use App\Models\TopBranch;

// LIBRARIES
use App\Libraries\Helper;

class TopBranchController extends Controller
{
    // SET THIS MODULE
    private $module = 'TopBranch';
    // SET THIS OBJECT/ITEM NAME
    private $item = 'topBranch';

    private function oneRecordwith_Rank($value, $top_branch){
        $newarr = array('id'=>$value->id, 'rank'=> $top_branch->rank, 'name' =>$value->name, 'created_at' => $top_branch->created_at);
        return $newarr;
    }

    public function getTopBranchWithName($branches){
        $data = array();
        foreach( $branches as $value ) {
            if($oneBranch = SysBranch::find($value->branch_id)){
                $data[] = $this->oneRecordwith_Rank($oneBranch, $value);
            }
        }
        return $data;
    }

    public function index()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View List');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $branches = TopBranch::all();
        $data =$this->getTopBranchWithName( $branches);
        // dd($data);
        return view('admin.top_branch.list', compact('data'));
    }

    public function create()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        //TODO: have to send only branch
        $data = SysBranch::all();
        $branches = $this->branch_with_null($data);
        return view('admin.top_branch.form', compact('branches'));
    }
    private function oneRecordwith_branchName($value){
        $newarr = array('id'=>$value->id, 'status'=> 1, 'name' =>$value->name, 'created_at' => $value->created_at);
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


    private function saveRecord($branch_id, $rank, $created_at, $table_name){

        if($created_at != null){
            if(!$table_name::insert([
                'rank'=> $rank,
                'branch_id' => $branch_id,
                'created_at' => $created_at
            ])){
                return false;
            }
        }
        else{
            $table_name::insert([
            'rank'=> $rank,
            'branch_id' => $branch_id
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
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        // LARAVEL VALIDATION
        $validation = [
            'branch_1' => 'required|not_in:0',
            'branch_2' => 'required|not_in:0',
            'branch_3' => 'required|not_in:0',
            'branch_4' => 'required|not_in:0',
            'branch_5' => 'required|not_in:0',
            'branch_6' => 'required|not_in:0',
            'branch_7' => 'required|not_in:0',
            'branch_8' => 'required|not_in:0',
            'branch_9' => 'required|not_in:0',
            'branch_10' => 'required|not_in:0',
        ];
        $message = [
            'required' => ':attribute ' . lang('field is required', $this->translation),
            'not_in:0' => ':attribute ' . lang('field is required', $this->translation),
            'unique' => ':attribute ' . lang('has already been taken, please input another data', $this->translation)
        ];
        $names = [
            'branch_1' => ucwords(lang('branch_1', $this->translation)),
            'branch_2' => ucwords(lang('branch_2', $this->translation)),
            'branch_3' => ucwords(lang('branch_3', $this->translation)),
            'branch_4' => ucwords(lang('branch_4', $this->translation)),
            'branch_5' => ucwords(lang('branch_5', $this->translation)),
            'branch_6' => ucwords(lang('branch_6', $this->translation)),
            'branch_7' => ucwords(lang('branch_7', $this->translation)),
            'branch_8' => ucwords(lang('branch_8', $this->translation)),
            'branch_9' => ucwords(lang('branch_9', $this->translation)),
            'branch_10' => ucwords(lang('branch_10', $this->translation)),
        ];
        $this->validate($request, $validation, $message, $names);

        $data = $request->all();
        array_splice($data, 0, 1);
        $unique = array_unique($data);
        if ( count($data) != count($unique) ) {
            return back()
                ->withInput()
                ->with('error', lang('all selected branches must be unique', $this->translation, ['#item' => ucwords(lang('department', $this->translation))]));
        }

        $top_branch = TopBranch::all();

        if(!$top_branch->isEmpty()){

            foreach($top_branch as $branches){
                if(!$this->saveRecord($branches->branch_id, $branches->rank, $branches->created_at, 'App\Models\ArchiveTopBranch')){
                    return back()
                    ->withInput()
                    ->with('error', lang('Oops, failed to set #item. Please try again.', $this->translation, ['#item' => 'Top Branches']));
                }
            }
            TopBranch::truncate();
        }

        if($this->saveAllRecords($data, 'App\Models\TopBranch')){
            return redirect()
            ->route('admin.top_branch.list')
            ->with('success', lang('Successfully set #item', $this->translation, ['#item' => 'Top Branches']));
        }


        // FAILED
        return back()
            ->withInput()
            ->with('error', lang('Oops, failed to set #item. Please try again.', $this->translation, ['#item' => 'Top Branches']));

    }

}


