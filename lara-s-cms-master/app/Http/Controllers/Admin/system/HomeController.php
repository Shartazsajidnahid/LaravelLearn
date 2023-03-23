<?php

namespace App\Http\Controllers\Admin\system;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\system\FilesController;

// MODELS
use App\Models\filetype;
use App\Models\files;
use App\Models\Employee;
use App\Models\Banner;
use App\Models\Employee_User;


class HomeController extends Controller
{
    public function index()
    {
        return view('admin.system.dashboard');
    }



    public function general_home()
    {
        // dd("nahid");
        $admin = Session::get('admin');
        $employee_user = Employee_User::where('user', $admin->id)->first();
        // dd($employee_user);
        $user = Employee::where('id', $employee_user->employee)->first();
        // dd($user);
        // GET THE BANNERS
        $query = Banner::whereNotNull('id');
        $banners = $query->orderBy('ordinal')->get();
        return view('general_user.home', compact('user', 'banners'));
    }

    public function general_team()
    {
        // $allfiles = files::all();
        $filetypes = filetype::all();
        $employees = Employee::all();
        $data = (new FilesController)->categorize($filetypes);
        return view('general_user.team', compact('data', 'filetypes', 'employees'));
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
