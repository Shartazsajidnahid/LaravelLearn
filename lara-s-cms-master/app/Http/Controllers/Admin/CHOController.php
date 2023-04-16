<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\Datatables\Datatables;
use App\Models\CHO;
use App\Models\system\SysBranch;


class CHOController extends Controller
{
    public function index()
    {

        $cho = CHO::all();
        // dd($applink);
        return view('admin.cho.index', compact('cho'));
    }

    public function create()
    {
        $branches = SysBranch::all();
        return view('admin.cho.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $selected = $request->input('selected');

        // dd(json_encode($selected, JSON_PRETTY_PRINT));
        $jsonD = json_encode($selected);
        // dd(json_decode($jsonD));

        $cho = new CHO;
        $cho->name = $request->input('name');
        $cho->email = $request->input('email');
        $cho->mobile = $request->input('mobile');
        $cho->designation = $request->input('designation');
        $cho->branches = $jsonD;

        $count = CHO::where('designation', $cho->designation )->count();

        if($cho->designation == 1){
            if($count >= 1){
                return back()
                ->withInput()
                ->with('error', lang('already one MD is available', $this->translation, ['#item' => ucwords(lang('cho', $this->translation))]));
            }
        }

        if($request->hasfile('profile_image'))
        {

            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/cho/', $filename);
            $cho->profile_image = $filename;
        }


        $cho->save();
        return redirect()->route('admin.cho.list')->with('success','cho has been created successfully.');
    }


    public function edit($id)
    {
        $cho = CHO::findOrFail($id);
        $selected = $cho->branches;
        $jsonBranch = json_decode($selected);
        // dd($jsonD);
        // if (in_array(4, $jsonBranch)) {
        //     dd('yes');
        // }
        // dd('no');
        $branches = SysBranch::all();
        return view('admin.cho.edit', compact('cho', 'branches', 'jsonBranch'));
    }

    public function update($id, Request $request)
    {
        $cho = CHO::findOrFail($id);
        $cho->currency = $request->input('currency');
        $cho->tt_buy = $request->input('tt_buy');
        $cho->tt_sell = $request->input('tt_sell');

        $cho->update();

        // SAVE THE DATA

        return redirect()->route('admin.cho.list')->with('success','cho has been Updated successfully.');
    }


    public function destroy($id)
    {
        $cho = CHO::findOrFail($id);

        $cho->delete();
        return redirect()->route('admin.cho.list')->with('success','cho has been deleted successfully.');
    }

}
