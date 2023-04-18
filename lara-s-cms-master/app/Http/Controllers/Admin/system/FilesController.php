<?php

namespace App\Http\Controllers\Admin\system;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Session;
use Illuminate\Support\Arr;

// LIBRARIES
use App\Libraries\Helper;

// MODELS
use App\Models\filetype;
use App\Models\files;
use App\Models\system\Division_admin;

class FilesController extends Controller
{
    // SET THIS MODULE
    private $module = 'File';
    // SET THIS OBJECT/ITEM NAME
    private $item = 'File';

    private function oneRecordwith_filetype($value){
        $newarr = array('id'=>$value->id,'filepath'=>$value->filepath, 'file_type'=> $value->file_type, 'name' =>$value->name , 'status'=>$value->status , 'created_at'=>$value->created_at, 'updated_at'=>$value->updated_at);
        $fileType = filetype::find($value->file_type);
        $newarr['filetypename'] = $fileType->filetype;
        return $newarr;
    }

    private function getDatawithfiletype($data){
        $newdata = array();

        foreach( $data as $value ) {
            $newarr = $this->oneRecordwith_filetype($value);
            $newdata[] = $newarr;
        }
        // dd($newdata);
        return $newdata;

    }

    public function categorize($types, $files){

        $newdata = array();
        foreach( $types as $data ) {

            $newarr = array();
            foreach($files as $value){
                if($value->file_type==$data->id){
                    $newarr[] = $value;
                };
            }
            $newdata[] = $newarr;
        }

        return $newdata;
    }

    public function list()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View List');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $allfiles = files::all();
        $filetypes = filetype::all();
        $data = $this->getDatawithfiletype($allfiles);
        // dd($data);
        return view('admin.file.list', compact('data', 'filetypes'));
    }


    public function create()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        $filetypes = filetype::all();

        return view('admin.file.form', compact('filetypes'));
    }

    public function do_create(Request $request)
    {

        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));


        // LARAVEL VALIDATION
        $validation = [
            'name' => 'required',
            'file' => 'required',
            'file_type' => 'required'
        ];
        $message = [
            'required' => ':attribute ' . lang('field is required', $this->translation)
        ];

        $name = [
            'file_type' => ucwords(lang('filetype', $this->translation))
        ];
        $this->validate($request, $validation, $message, $name);

        // HELPER VALIDATION FOR PREVENT SQL INJECTION & XSS ATTACK
        $file_type = (int) $request->file_type;
        if ($file_type < 1) {
            return back()
                ->withInput()
                ->with('error', lang('#item must be chosen at least one', $this->translation, ['#item' => ucwords(lang('filetype', $this->translation))]));
        }
        $name = Helper::validate_input_text($request->name);
        if (!$name) {
            return back()
                ->withInput()
                ->with('error', lang('Invalid format for #item', $this->translation, ['#item' => ucwords(lang('name', $this->translation))]));
        }
        // dd($request->status);
        // dd($request->file('file'));

        //find division_admin_id
        $admin = Session::get('admin');


        if($request->file('file')) {

            $file = $request->file('file');
            $filename = $file->hashName();

            //create files folder
            $path = 'uploads/files';
            if(! File::exists($path)) {
                // path does not exist
                File::makeDirectory($path);
            }

            $type = filetype::where('id', $file_type)->pluck('filetype');
            // File upload location

            $path = 'uploads/files/'.$admin->name.'-'.$admin->id;
            if(! File::exists($path)) {
                // path does not exist
                File::makeDirectory($path);
            }



            $location = 'uploads/files/'.$admin->name.'-'.$admin->id.'/'.$type[0];
            // dd($location);

            if (! File::exists($location)) {
                File::makeDirectory($location);
            }

            // Upload file
            $file->move($location,$filename);

            // File path
            $filepath = url( $location.'/'.$filename);
        }
        else{
            return back()
                ->withInput()
                ->with('error', lang('one #item must be chosen', $this->translation, ['#item' => ucwords(lang('file', $this->translation))]));
        }

        // dd($admin);

        // SAVE THE DATA
        $data = new files();
        $data->name = $name;
        $data->file_type = $file_type;
        $data->filepath = $filepath;

        // dd($data);

        if($request->status){
            $data->status = 1;
        }
        else{
            $data->status = 0;
        }

        $division_admin = DB::table('division_admins')->where('admin_id', $admin->id)->first();

        if($division_admin){
            $data->division_admin_id = $division_admin->id;
            // SAVE THE DATA
            if ($data->save()) {
                // SUCCESS
                return redirect()
                    ->route('admin.file.list')
                    ->with('success', lang('Successfully added a new #item', $this->translation, ['#item' => $this->item]));
            }
        }
        // FAILED
        return back()
            ->withInput()
            ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));
    }

    public function edit($id)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View Details');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));

        // CHECK OBJECT ID
        if ((int) $id < 1) {
            // INVALID OBJECT ID
            return redirect()
                ->route('admin.file.list')
                ->with('error', lang('#item ID is invalid, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }

        // GET THE DATA BASED ON ID
        $data = files::find($id);

        // CHECK IS DATA FOUND
        if (!$data) {
            // DATA NOT FOUND
            return redirect()
                ->route('admin.file.list')
                ->with('error', lang('#item not found, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }
        $filetypes = filetype::all();
        return view('admin.file.form', compact('data', 'filetypes'));
    }

    public function do_edit($id, Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Edit');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));

        // LARAVEL VALIDATION
        $validation = [
            'name' => 'required',
            'file' => 'required',
            'file_type' => 'required'
        ];
        $message = [
            'required' => ':attribute ' . lang('field is required', $this->translation)
        ];

        $name = [
            'file_type' => ucwords(lang('filetype', $this->translation))
        ];
        $this->validate($request, $validation, $message, $name);

        // HELPER VALIDATION FOR PREVENT SQL INJECTION & XSS ATTACK
        $file_type = (int) $request->file_type;
        if ($file_type < 1) {
            return back()
                ->withInput()
                ->with('error', lang('#item must be chosen at least one', $this->translation, ['#item' => ucwords(lang('filetype', $this->translation))]));
        }
        $name = Helper::validate_input_text($request->name);
        if (!$name) {
            return back()
                ->withInput()
                ->with('error', lang('Invalid format for #item', $this->translation, ['#item' => ucwords(lang('name', $this->translation))]));
        }
        // dd($request->status);
        // dd($request->file('file'));

        //find division_admin_id
        $admin = Session::get('admin');


        if($request->file('file')) {

            $file = $request->file('file');
            $filename = $file->hashName();

            //create files folder
            $path = 'uploads/files';
            if(! File::exists($path)) {
                // path does not exist
                File::makeDirectory($path);
            }

            $type = filetype::where('id', $file_type)->pluck('filetype');
            // File upload location

            $path = 'uploads/files/'.$admin->name.'-'.$admin->id;
            if(! File::exists($path)) {
                // path does not exist
                File::makeDirectory($path);
            }

            $location = 'uploads/files/'.$admin->name.'-'.$admin->id.'/'.$type[0];
            // dd($location);

            if (! File::exists($location)) {
                File::makeDirectory($location);
            }

            // Upload file
            $file->move($location,$filename);

            // File path
            $filepath = url( $location.'/'.$filename);
        }
        else{
            return back()
                ->withInput()
                ->with('error', lang('one #item must be chosen', $this->translation, ['#item' => ucwords(lang('file', $this->translation))]));
        }

        // dd($admin);

        // SAVE THE DATA
        $data = files::find($id);
        $data->name = $name;
        $data->file_type = $file_type;
        $data->filepath = $filepath;

        // dd($data);

        if($request->status){
            $data->status = 1;
        }
        else{
            $data->status = 0;
        }
        // UPDATE THE DATA
        if ($data->save()) {
            // SUCCESS
            return redirect()
                ->route('admin.file.list', $id)
                ->with('success', lang('Successfully updated #item', $this->translation, ['#item' => $this->item]));
        }

        // FAILED
        return back()
            ->withInput()
            ->with('error', lang('Oops, failed to update #item. Please try again.', $this->translation, ['#item' => $this->item]));
    }

    public function sorting(Request $request)
    {
        // AJAX OR API VALIDATOR
        $validation_rules = [
            'rows' => 'required'
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error',
                'data' => $validator->errors()->messages()
            ]);
        }

        // JSON Array - sample: row[]=2&row[]=1&row[]=3
        $rows = $request->input('rows');

        // convert to array
        $data = explode('&', $rows);

        $ordinal = 1;
        foreach ($data as $item) {
            // split the data
            $tmp = explode('[]=', $item);

            $object = Banner::find($tmp[1]);
            $object->ordinal = $ordinal;
            $object->save();

            $ordinal++;
        }

        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Successfully rearranged data',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function delete(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Delete');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));

        $id = $request->id;

        // CHECK OBJECT ID
        if ((int) $id < 1) {
            // INVALID OBJECT ID
            return redirect()
                ->route('admin.file.list')
                ->with('error', lang('#item ID is invalid, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }

        // GET THE DATA BASED ON ID
        $data = filetype::find($id);

        // CHECK IS DATA FOUND
        if (!$data) {
            // DATA NOT FOUND
            return redirect()
                ->route('admin.file.list')
                ->with('error', lang('#item not found, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }

        // DELETE THE DATA
        if ($data->delete()) {
            // SUCCESS
            return redirect()
                ->route('admin.file.list')
                ->with('success', lang('Successfully deleted #item', $this->translation, ['#item' => $this->item]));
        }

        // FAILED
        return back()
            ->with('error', lang('Oops, failed to delete #item. Please try again.', $this->translation, ['#item' => $this->item]));
    }

    public function list_deleted()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Restore');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        return view('admin.banner.list');
    }

    public function get_data_deleted(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View List');
        if ($authorize['status'] != 'true') {
            return response()->json([
                'status' => 'false',
                'message' => $authorize['message']
            ]);
        }

        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));

        // AJAX OR API VALIDATOR
        $validation_rules = [
            // 'division' => 'required'
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error',
                'data' => $validator->errors()->messages()
            ]);
        }

        // GET THE DATA
        $query = Banner::onlyTrashed();

        // PROVIDE THE DATA
        $data = $query->orderBy('ordinal')->get();

        // MANIPULATE THE DATA
        if (!empty($data)) {
            foreach ($data as $item) {
                $item->created_at_edited = date('Y-m-d H:i:s');
                $item->updated_at_edited = Helper::time_ago(strtotime($item->updated_at), lang('ago', $this->translation), Helper::get_periods($this->translation));
                $item->deleted_at_edited = Helper::time_ago(strtotime($item->deleted_at), lang('ago', $this->translation), Helper::get_periods($this->translation));
                $item->image_item = asset($item->image);
            }
        }

        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Successfully get data list',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function restore(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Restore');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        // SET THIS OBJECT/ITEM NAME BASED ON TRANSLATION
        $this->item = ucwords(lang($this->item, $this->translation));

        $id = $request->id;

        // CHECK OBJECT ID
        if ((int) $id < 1) {
            // INVALID OBJECT ID
            return redirect()
                ->route('admin.banner.deleted')
                ->with('error', lang('#item ID is invalid, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }

        // GET THE DATA BASED ON ID
        $data = Banner::onlyTrashed()->find($id);

        // CHECK IS DATA FOUND
        if (!$data) {
            // DATA NOT FOUND
            return redirect()
                ->route('admin.banner.deleted')
                ->with('error', lang('#item not found, please recheck your link again', $this->translation, ['#item' => $this->item]));
        }

        // RESTORE THE DATA
        if ($data->restore()) {
            // SUCCESS
            return redirect()
                ->route('admin.banner.deleted')
                ->with('success', lang('Successfully restored #item', $this->translation, ['#item' => $this->item]));
        }

        // FAILED
        return back()
            ->with('error', lang('Oops, failed to restore #item. Please try again.', $this->translation, ['#item' => $this->item]));
    }

    public function get_files(Request $request){
        $filetypeid =  $request->input('filetypeid');
        if( $filetypeid == 0){
            $branches = files::all();
        }
        else{
            $filetypeid = (int) $request->input('filetypeid');
            $branches = files::where('file_type', $filetypeid)->orderBy('name', 'asc')->get();
        }
        $data = $this->getDatawithfiletype($branches);
        $html = '';

        $response = [
            'status' => 'true',
            'message' => 'Successfully get data list',
            'data' => $data
        ];
        return response()->json($response, 200);
    }
}

