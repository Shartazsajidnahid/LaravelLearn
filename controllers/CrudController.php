<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{

    public function showData(){
        return view('show_data');
    }

    public function addData(){
        return view('adduser');
    }
}
