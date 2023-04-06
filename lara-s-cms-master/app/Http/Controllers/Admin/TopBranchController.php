<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\Datatables\Datatables;
use App\Models\Exchange_rate;
use App\Models\system\SysBranch;

class TopBranchController extends Controller
{
    public function index()
    {
        // $links = exchange_rate::all();
        // dd($applink);
        return view('admin.top_branch.list');
    }

    public function create()
    {
        $data = SysBranch::all();
        $branches = $this->branch_with_null($data);
        return view('admin.top_branch.form', compact('branches'));
    }
    private function oneRecordwith_branchName($value){
        $newarr = array('id'=>$value->id, 'status'=> 1, 'name' =>$value->name);
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

    public function store(Request $request)
    {
        dd((int)$request->branch_10);
        $exchange_rate = new exchange_rate;
        $exchange_rate->currency = $request->input('currency');
        $exchange_rate->tt_buy = $request->input('tt_buy');
        $exchange_rate->tt_sell = $request->input('tt_sell');

        // dd($applink);
        $exchange_rate->save();

        // SAVE THE DATA

        return redirect()->route('admin.exchange_rates.list')->with('success','Exchange_rates has been created successfully.');
    }

    public function show($id)
    {

    }
    public function edit($id)
    {
        $exchange_rate = exchange_rate::findOrFail($id);
        return view('admin.exchange_rate.edit', compact('exchange_rate'));
    }

    public function update($id, Request $request)
    {
        $exchange_rate = exchange_rate::findOrFail($id);
        $exchange_rate->currency = $request->input('currency');
        $exchange_rate->tt_buy = $request->input('tt_buy');
        $exchange_rate->tt_sell = $request->input('tt_sell');

        // dd($applink);

        $exchange_rate->update();

        // SAVE THE DATA

        return redirect()->route('admin.exchange_rates.list')->with('success','Exchange_rates has been Updated successfully.');
    }


    public function destroy($id)
    {
        $exchange_rate = exchange_rate::findOrFail($id);

        $exchange_rate->delete();
        return redirect()->route('admin.exchange_rates.list')->with('success','exchange_rates has been created successfully.');
    }

}


