<?php

namespace App\Http\Controllers\Admin\system;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.system.dashboard');
    }
    public function general_home()
    {
        $users = ["First p", "Second p", "Third p"];
        return view('general_user.home', compact('users'));
    }

    public function general_team()
    {
        return view('general_user.team');
    }

    public function general_aboutus()
    {
        return view('general_user.about-us');
    }

    public function general_allbrance()
    {
        return view('general_user.allbrance');
    }

    public function general_alldivision()
    {
        return view('general_user.alldivision');
    }
}
