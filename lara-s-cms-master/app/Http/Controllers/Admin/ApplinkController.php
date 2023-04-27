<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use Yajra\Datatables\Datatables;
use App\Models\Applink;

// LIBRARIES
use App\Libraries\Helper;

class ApplinkController extends Controller
{
    // SET THIS MODULE
    private $module = 'Applink';
    // SET THIS OBJECT/ITEM NAME
    private $item = 'applink';

    public function index()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View Details');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $links = Applink::all();
        // dd($applink);
        return view('admin.applink.index', compact('links'));
    }

    public function create()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        return view('admin.applink.create');
    }

    public function do_create(Request $request)
    {
         // AUTHORIZING...
         $authorize = Helper::authorizing($this->module, 'Add New');
         if ($authorize['status'] != 'true') {
             return back()->with('error', $authorize['message']);
         }

         // LARAVEL VALIDATION
        $validation = [
            'name' => 'required',
            'link' => 'required'
        ];
        $message = [
            'required' => ':attribute ' . lang('field is required', $this->translation),
            ];
        $names = [
            'name' => ucwords(lang('name', $this->translation)),
            'link' => ucwords(lang('link', $this->translation))
        ];
        $this->validate($request, $validation, $message, $names);

        $applink = new Applink;
        $applink->name = $request->input('name');
        $applink->link = $request->input('link');

        // dd($applink);

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/applinks/', $filename);
            $applink->image = $filename;
        }

        try {
            if(  $applink->save()){
            // SUCCESS


        return redirect()->route('admin.applink.list')->with('success','Applinks has been created successfully.');
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
         return view('admin.applink.create');
        $applink = Applink::findOrFail($id);
        $destination = 'uploads/applinks/'.$applink->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $applink->delete();
        return redirect()->route('admin.applink.list')->with('success','Applinks has been created successfully.');
    }

}
