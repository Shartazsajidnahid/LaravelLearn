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
        $cho = CHO::all();
        // dd($applink);
        return view('admin.cho.index', compact('cho'));
    }

    public function create()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $branches = SysBranch::all();
        return view('admin.cho.create', compact('branches'));
    }

    public function store(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
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


    public function edit($id)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View Details');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $cho = CHO::findOrFail($id);
        $selected = $cho->branches;
        $jsonBranch = json_decode($selected);
        $branches = SysBranch::all();
        return view('admin.cho.edit', compact('cho', 'branches', 'jsonBranch'));
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
