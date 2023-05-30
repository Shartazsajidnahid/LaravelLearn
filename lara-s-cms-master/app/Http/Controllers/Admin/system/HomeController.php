<?php

namespace App\Http\Controllers\Admin\system;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\system\FilesController;
use App\Http\Controllers\Admin\system\EmployeeController;
use App\Http\Controllers\Admin\TopBranchController;
use App\Http\Controllers\Admin\TopDepositorController;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

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
use App\Models\TopBranch;
use App\Models\TopDepositor;
use App\Models\ArchiveTopBranch;
use App\Models\ArchiveTopDepositor;
use App\Models\CHO;
use App\Models\Article;


class Sub_branch {
    public $id;
    public $name;
    public $sub_branches;
    public $href;
    function __construct($id, $name, $sub_branches) {
        $this->id = $id;
        $this->name = $name;
        $this->sub_branches = $sub_branches;
        $nospace = str_replace(' ', '', $name);
        $this->href = preg_replace('/[^A-Za-z0-9\-]/', '', $nospace);
    }
}

class Depts {
    public $id;
    public $name;
    public $units;
    public $href;
    function __construct($id, $name, $units) {
        $this->id = $id;
        $this->name = $name;
        $this->units = $units;
        $nospace = str_replace(' ', '', $name);
        $this->href = preg_replace('/[^A-Za-z0-9\-]/', '', $nospace);
    }
}

class Unit {
    public $id;
    public $name;
    public $units;
    public $href;
    function __construct($id, $name, $units) {
        $this->id = $id;
        $this->name = $name;
        $this->units = $units;
        $nospace = str_replace(' ', '', $name);
        $this->href = preg_replace('/[^A-Za-z0-9\-]/', '', $nospace);
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

    function getTopBranches(){

        if(TopBranch::exists()){
            $data = TopBranch::all();
        }
        else{
            $data = ArchiveTopBranch::latest()->take(10)->get();
        }
        $branches = (new TopBranchController)->getTopBranchWithName($data);
        return $branches;
    }

    function getTopDepositors(){

        if(TopDepositor::exists()){
            $data = TopDepositor::all();
        }
        else{
            $data = ArchiveTopDepositor::latest()->take(10)->get();
        }
        $topEmployees = (new TopDepositorController)->getTopDepositorWithName($data);
        return $topEmployees;
    }

    public function general_home()
    {
        // USER INFO
        $admin = Session::get('admin');
        $employee_user = Employee_User::where('user', $admin->id)->first();

        $user = Employee::where('id', $employee_user->employee)->first();
        // $user = (new EmployeeController)->oneRecordwith_names($user_raw);

        // BANNERS
        $query = Banner::whereNotNull('id');
        $banners = $query->orderBy('ordinal')->get();

        // NEWS
        // $news = Topic::select("*")
        // ->where([
        //     ["status", "=", 1],
        //     ["description", "!=", null]
        // ])
        // ->get();

        $articles = Article::all();


        // APPLINKS
        $applinks_up = Applink::where('up' , 1)->get();
        $applinks_down = Applink::where('up', 2)->get();

        // EXCHANGE RATES
        $exchange_rate = Exchange_rate::all();

        // TOP BRANCHES
        $top_branches = $this->getTopBranches();

        // TOP Employees
        $top_employees = $this->getTopDepositors();

        return view('general_user.home', compact('user', 'banners', 'articles', 'applinks_up', 'applinks_down', 'exchange_rate', 'top_branches', 'top_employees'));
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

        // GET THE DATA
        $employees = Employee::select(
            'employees.*'
        )
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->where($office, '=', $id)
            ->orderBy('designations.seniority_order', 'ASC')
            ->get();
        return $employees;
    }

    private function getFiles($home,$id){
        $office = $this->getIDname($home);

        $files = DB::table('files')
            ->leftJoin('division_admins', 'files.division_admin_id', '=', 'division_admins.id')
            ->where('division_admins.'.$office, '=', $id)
            ->get();
        return $files;
    }

    public function general_team($home,$id)
    {
        //get breanch, dept or unit
        $office = DB::table($home)
            ->where('id', '=', $id)
            ->first();

        //get employees
        $employees = $this->getEmployees($home,$id);

        $filetypes = filetype::all();
        $data = (new FilesController)->categorize($filetypes, $this->getFiles($home,$id));

        return view('general_user.team', compact('data', 'filetypes', 'employees', 'office'));
    }

    function choWithBranch($value){
        $cho = Employee::where('user_name', $value->user_id)->first();
        $newarr = array('name'=>$cho->name, 'profile_image'=>$cho->profile_image, 'user_name'=>$cho->user_name);

        if($value->position == 1){
            $newarr['position'] = "MD";
        }
        else if($value->position == 2){
            $newarr['position'] = $newarr['position'] = "DMD";
        }

        $jsonBranches = json_decode($value->branches);

        $branches = [];
        foreach($jsonBranches as $item){

            $oneBranch = SysBranch::find($item);

            if(!empty($oneBranch)){
                $branches[] = $oneBranch;
            }
        }

        if($value->position == 1)
            $branches = array_chunk($branches, ceil(count($branches)/2));
        $newarr['branches'] = $branches;

        return $newarr;
    }

    public function general_aboutus()
    {

        try {
             // get MD and branches
            $md_id = 1;
            $dmd_id = 2;
            $md_record = CHO::where('position', $md_id)->first();

            if($md_record){
                $md = $this->choWithBranch($md_record);
            }
            else{
                $md = [];
            }


            $dmds_record = CHO::where('position', $dmd_id)->get();
            $dmds = [];
            foreach($dmds_record as $item){
                $dmds[] = $this->choWithBranch($item);
            }
            // dd($dmds);
            return view('general_user.about-us', compact('md','dmds'));

       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error');

       }

    }

    public function general_allbrance()
    {
        $branchID = 2;
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('division_id', '=', $branchID )
            ->where('status', '=', 1 )
            ->get();
          $sub_branches = [];
          foreach($responses as $branch){
              $br_id = $branch->id;
              if($branch->parent_id == 0){
                $sub_br = DB::table('sys_branches')
                ->where('parent_id', '=', $br_id )
                ->where('status', '=', 1 )
                ->get();
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
            ->where('status', '=', 1 )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        // dd($branches);
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Sub-branches']);
    }

    public function general_branch()
    {
        $branchID = 2;
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('division_id', '=', $branchID )
            ->where('parent_id', '=', 0 )
            ->where('status', '=', 1 )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Branches']);
    }

    public function general_division()
    {
        $headofficeID = 1;
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
          $responses = DB::table('sys_branches')
            ->where('name', 'like',  $cur_char.'%')
            ->where('division_id', '=', $headofficeID )
            ->get();

          $resType = new ResponseType($cur_char, $responses);
          array_push($branches, $resType);
        }
        return view('general_user.sub_branch', ['branches'=>$branches], ['title'=> 'Divisions']);
    }


    public function general_alldivision()
    {
        $headofficeID = 1;
        $branches = [];
        foreach( range('a', 'z') as $cur_char ){
          $temp_branches = [];
          $responses = DB::table('sys_branches')
          ->where('name', 'like',  $cur_char.'%')
          ->where('division_id', '=', $headofficeID )
          ->where('status', '=', 1 )
          ->get();

          //Get the departments
          foreach($responses as $branch){
              $br_id = $branch->id;
              $sub_depts = DB::table('sys_departments')
                ->where('branch_id', '=', $br_id )
                ->where('status', '=', 1 )
                ->get();

              //Get the units
              $units = [];
              unset($depts);
              $depts = [];
                foreach($sub_depts as $dept){
                    $units = DB::table('sys_units')
                        ->where('department_id', '=', $dept->id )
                        ->where('status', '=', 1 )
                        ->get();
                    // $units = DB::select('select * from sys_units where department_id='.$dept->id);

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

    public function general_allfiles()
    {
        $filetypes = filetype::all();
        $files = files::select(
            'files.*',
            'sys_branches.name as branch',
            'sys_departments.name as department',
            'sys_units.name as unit',

        )
            ->leftJoin('division_admins', 'files.division_admin_id', '=', 'division_admins.id')
            ->leftJoin('sys_branches', 'division_admins.branch_id', '=', 'sys_branches.id')
            ->leftJoin('sys_departments', 'division_admins.department_id', '=', 'sys_departments.id')
            ->leftJoin('sys_units', 'division_admins.unit_id', '=', 'sys_units.id')
            ->get();

        // dd($files);
        // $data = (new FilesController)->categorize($filetypes, $files);
        // dd($data);
        return view('general_user.allfiles', compact('files', 'filetypes'));

    }

    public function general_allemployees()
    {
        $allemployees = Employee::select(
            'employees.*',
            'sys_branches.name as branch',
            'sys_departments.name as department',
            'sys_units.name as unit',
            'designations.designation as designation',
            'functional_designations.designation as functional_designation',

        )

            ->leftJoin('sys_branches', 'employees.branch_id', '=', 'sys_branches.id')
            ->leftJoin('sys_departments', 'employees.department_id', '=', 'sys_departments.id')
            ->leftJoin('sys_units', 'employees.unit_id', '=', 'sys_units.id')
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->leftJoin('functional_designations', 'employees.func_designation_id', '=', 'functional_designations.id')
            ->orderBy('designations.seniority_order', 'DESC')
            ->get();

        // dd($allemployees);
        return view('general_user.allemployees', compact('allemployees'));

    }

    public function general_all_div_info()
    {
        $branches = SysBranch::select(
            'sys_branches.name as name',
            'sys_branches.location as location',
            'sys_branches.phone as phone',
        )
        ->get();
        return view('general_user.all_branch_dept_unit', compact('branches' ));

    }



    public function update_image(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        if($request->hasfile('profile_image'))
        {
            $destination = 'uploads/employees/'.$employee->profile_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/employees/' . $employee->user_name . '/', $filename);
            $employee->profile_image = $filename;
        }

        try {
            if( $employee->update()){
                return back();
            }

       } catch (QueryException $e) {
            // FAILED
            return back()
            ->withInput()
            ->with('error', lang('#item could not be updated', $this->translation, ['#item' => "Employee"]));

       }
    }

    public function get_data(Request $request)
    {
        // dd($request->input('filetype'));
        $filetype = (int) $request->input('filetype');
        // dd("hapi hapi hapi");
        if($filetype==0){
            $data = files::select(
                'files.*',
                'sys_branches.name as branch',
                'sys_departments.name as department',
                'sys_units.name as unit',
            )
                ->leftJoin('division_admins', 'files.division_admin_id', '=', 'division_admins.id')
                ->leftJoin('sys_branches', 'division_admins.branch_id', '=', 'sys_branches.id')
                ->leftJoin('sys_departments', 'division_admins.department_id', '=', 'sys_departments.id')
                ->leftJoin('sys_units', 'division_admins.unit_id', '=', 'sys_units.id')
                ->get();
        }
        else{
            $data = files::select(
                'files.*',
                'sys_branches.name as branch',
                'sys_departments.name as department',
                'sys_units.name as unit',
            )
                ->leftJoin('division_admins', 'files.division_admin_id', '=', 'division_admins.id')
                ->leftJoin('sys_branches', 'division_admins.branch_id', '=', 'sys_branches.id')
                ->leftJoin('sys_departments', 'division_admins.department_id', '=', 'sys_departments.id')
                ->leftJoin('sys_units', 'division_admins.unit_id', '=', 'sys_units.id')
                ->where('files.file_type', '=', $filetype)
                ->get();

        }



        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Successfully get data list',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

}
