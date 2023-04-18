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
        $branches = SysBranch::all();
        return view('admin.cho.edit', compact('cho', 'branches', 'jsonBranch'));
    }

    public function update($id, Request $request)
    {
        $selected = $request->input('selected');
        $jsonD = json_encode($selected);


        $cho = CHO::findOrFail($id);
        $cho->name = $request->input('name');
        $cho->email = $request->input('email');
        $cho->mobile = $request->input('mobile');
        $cho->designation = $request->input('designation');
        $cho->branches = $jsonD;

        if($request->hasfile('profile_image'))
        {
            $destination = 'uploads/cho/'.$cho->profile_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/cho/', $filename);
            $cho->profile_image = $filename;
        }
        $cho->save();
        return redirect()->route('admin.cho.list')->with('success','cho has been updated successfully.');
    }


    public function destroy($id)
    {
        $cho = CHO::findOrFail($id);

        $cho->delete();
        return redirect()->route('admin.cho.list')->with('success','cho has been deleted successfully.');
    }

}
