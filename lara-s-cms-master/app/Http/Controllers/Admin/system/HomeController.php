<?php

namespace App\Http\Controllers\Admin\system;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\system\FilesController;
use App\Http\Controllers\Admin\system\EmployeeController;
use Carbon\Carbon;

// MODELS
use App\Models\filetype;
use App\Models\files;
use App\Models\Employee;
use App\Models\Banner;
use App\Models\Employee_User;
use App\Models\system\SysBranch;
use App\Models\Topic;
use App\Models\Applink;
use App\Models\Exchange_rate;
use App\Models\system\Division_admin;

class Sub_branch {
    public $id;
    public $name;
    public $sub_branches;
    function __construct($id, $name, $sub_branches) {
        $this->id = $id;
        $this->name = $name;
        $this->sub_branches = $sub_branches;
    }
}

class Depts {
    public $id;
    public $name;
    public $units;
    function __construct($id, $name, $units) {
        $this->id = $id;
        $this->name = $name;
        $this->units = $units;
    }
}

class Unit {
    public $id;
    public $name;
    public $units;
    function __construct($id, $name, $units) {
        $this->id = $id;
        $this->name = $name;
        $this->units = $units;
    }
}

class ResponseType{
    public $char;
    public $branches;

    function __construct($char, $branches) {
        $this->char = $char;
        $this->branches = $branches;
    }
    function get_name() {
        return $this->name;
    }
}

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
        $user_raw = Employee::where('id', $employee_user->employee)->first();
        $user = (new EmployeeController)->oneRecordwith_names($user_raw);
        // dd($user);
        // GET THE BANNERS
        $query = Banner::whereNotNull('id');
        $banners = $query->orderBy('ordinal')->get();

        // GET THE NEWS
        $news = Topic::select("*")
        ->where([
            ["status", "=", 1],
            ["description", "!=", null]
        ])
        ->get();

        // GET THE APPLINKS
        $applinks = Applink::all();

        // GET THE EXCHANGE RATES
        $exchange_rate = Exchange_rate::all();

        // dd($news);

        return view('general_user.home', compact('user', 'banners', 'news', 'applinks', 'exchange_rate'));
    }
    private function getIDname($home){
        $office = '';
        if($home=='sys_branches') $office = 'branch_id';
        else if($home=='sys_departments') $office = 'department_id';
        else $office = 'unit_id';
        return $office;
    }

    private function getEmployees($home,$id){
        $office = $this->getIDname($home);

        $employees = DB::table('employees')
            ->where($office, '=', $id)
            ->get();
        return $employees;
    }

    private function getFiles($home,$id){
        $office = $this->getIDname($home);

        // $files = Division_admin::select(
        //     'files.*'
        // )
        //     ->leftJoin('files', 'files.division_admin_id', '=', 'division_admins.id')
        //     // ->leftJoin($home, 'division_admins.'.$office, '=', $home.'.id')
        //     ->where('division_admins.'.$office, '=', $id)
        //     ->get();

        // dd($id);

        $files = DB::table('files')
            ->leftJoin('division_admins', 'files.division_admin_id', '=', 'division_admins.id')
            ->where('division_admins.'.$office, '=', $id)
            ->get();



        // $files = DB::table('employees')
        //     ->where($office, '=', $id)
        //     ->get();

        // dd($files);
        return $files;
    }

    public function general_team($home,$id)
    {

        //get breanch, dept or unit
        $office = DB::table($home)
            ->where('id', '=', $id)
            ->first();

        //get employees
        $user_raw = $this->getEmployees($home,$id);
        // $user_raw = Employee::where('id', $employee_user->employee)->first();
        $employees = (new EmployeeController)->getDatawithNames($user_raw);

        // $allfiles = files::all();
        $filetypes = filetype::all();
        $data = (new FilesController)->categorize($filetypes, $this->getFiles($home,$id));

        return view('general_user.team', compact('data', 'filetypes', 'employees', 'office'));
    }

    public function general_aboutus()
    {
        return view('general_user.about-us');
    }

    public function general_allbrance()
    {
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
        //   $responses = DB::select('select * from sys_branches where name like \'' . $cur_char . '%\''); //and Branch, not Head Office
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->get();
          $sub_branches = [];
          foreach($responses as $branch){
              $br_id = $branch->id;
              if($branch->parent_id == 0){
                $sub_br = DB::select('select * from sys_branches where parent_id='.$br_id);
                $temp = new Sub_branch($branch->id,$branch->name, $sub_br);
                array_push($sub_branches, $temp);
              }
          }
          $resType = new ResponseType($cur_char, $sub_branches);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.allbrance', ['branches'=>$branches]);
    }

    public function general_subbranch()
    {
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
        //   $responses = DB::select('select * from sys_branches where name like \'' . $cur_char . '%\''); //and Branch, not Head Office
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('parent_id', '!=', 0 )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Sub-branches']);
    }

    public function general_branch()
    {
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
        //   $responses = DB::select('select * from sys_branches where name like \'' . $cur_char . '%\''); //and Branch, not Head Office
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('parent_id', '=', 0 )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Branches']);
    }

    public function general_division()
    {
        // $mytime = Carbon::now();
        // dd( $mytime->toDateString());
        // dd( $mytime->toDateTimeString());
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
        //   $responses = DB::select('select * from sys_branches where name like \'' . $cur_char . '%\''); //and Branch, not Head Office
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('division_id', '=', 2 )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Divisions']);
    }


    public function general_alldivision()
    {
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
          $temp_branches = [];
          $responses = DB::select('select * from sys_branches where name like \'' . $cur_char . '%\''); //and Head Office


          //Get the departments
          foreach($responses as $branch){
              $br_id = $branch->id;
              $sub_depts = DB::select('select * from sys_departments where branch_id='.$br_id);

              //Get the units
              $units = [];
              unset($depts);
              $depts = [];
                foreach($sub_depts as $dept){
                    $units = DB::select('select * from sys_units where department_id='.$dept->id);

                    unset($temp_dept);

                    $temp_dept = [];
                    $temp_dept = new Unit($dept->id,$dept->name, $units);
                        // dd($temp_dept);
                    array_push($depts, $temp_dept);

                  }

                  $temp = new Sub_branch($branch->id,$branch->name, $depts);
                  array_push($temp_branches, $temp);
          }
          $resType = new ResponseType($cur_char, $temp_branches);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.alldivision', ['branches'=>$branches]);
    }

    public function cho_index()
    {
        return view('admin.system.cho.form');
    }

    public function cho_create()
    {
        return view('admin.system.cho.form');
    }

}
