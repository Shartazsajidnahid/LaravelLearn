<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class CrudController extends Controller
{

    public function showData(){
        $allData = Crud::simplePaginate(5);
        return view('show_data', compact('allData'));
    }

    public function addData(){
        return view('adduser');
    }

    public function storeData(Request $request){
        $rules = [
            'name' => 'required|max:10',
            'phone' => 'required|max:5',
            'address' => 'required',
        ];

        $this->validate($request, $rules);

        $crud = new Crud();
        $crud->name = $request->name;
        $crud->phone = $request->phone;
        $crud->address = $request->address;
        $crud->save();

        Session::flash('status','Data Added Successfully');
        // return redirect()->back();
        return redirect('/');

    }

    public function editData($id){

        $user = Crud::find($id);
        return view('edit_data', compact('user'));
        return view('edit_data');
    }

    public function updateData(Request $request, $id){

        $user = Crud::find($id);
        $user->name =  $request->name;
        $user->phone =  $request->phone;
        $user->address =  $request->address;

        $user->update();
        // return redirect()->back()->with('status','User Updated Successfully');
        // return view('show_data');
        Session::flash('status','Data Updated Successfully');
        return view('edit_data', compact('user'));
    }

    public function deleteData($id){

        $user = Crud::find($id);
        $user->delete();
        return redirect()->back()->with('status','User Deleted Successfully');
        return view('show_data');
    }


}
