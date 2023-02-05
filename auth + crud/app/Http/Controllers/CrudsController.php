<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cruds;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class CrudsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function showData(){
        $allData = cruds::simplePaginate(5);
        return view('crud.show_data', compact('allData'));
    }

    public function addData(){
        return view('crud.adduser');
    }

    public function storeData(Request $request){
        $rules = [
            'name' => 'required|max:10',
            'phone' => 'required|max:5',
            'address' => 'required',
        ];

        $this->validate($request, $rules);

        $crud = new cruds();
        $crud->name = $request->name;
        $crud->phone = $request->phone;
        $crud->address = $request->address;
        $crud->save();

        Session::flash('status','Data Added Successfully');
        // return redirect()->back();
        return redirect('/');

    }

    public function editData($id){

        $user = cruds::find($id);
        return view('crud.edit_data', compact('user'));
        return view('crud.edit_data');
    }

    public function updateData(Request $request, $id){

        $user = cruds::find($id);
        $user->name =  $request->name;
        $user->phone =  $request->phone;
        $user->address =  $request->address;

        $user->update();
        // return redirect()->back()->with('status','User Updated Successfully');
        // return view('show_data');
        Session::flash('status','Data Updated Successfully');
        return view('crud.edit_data', compact('user'));
    }

    public function deleteData($id){

        $user = cruds::find($id);
        $user->delete();
        return redirect()->back()->with('status','User Deleted Successfully');
        return view('crud.show_data');
    }


}
