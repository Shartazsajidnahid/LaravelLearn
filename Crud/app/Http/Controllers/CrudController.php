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

        Session::flash('msg','Data Added Successfully');
        return redirect('/');
    }
}
