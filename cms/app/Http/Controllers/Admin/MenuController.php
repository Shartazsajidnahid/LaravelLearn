<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// LIBRARIES
use App\Libraries\Helper;

// MODELS
use App\Models\Menu;
use App\Models\DynController;
use App\Models\functions;

class MenuController extends Controller
{

    private function create_file($name){
        // Storage::put('E:/xamp/htdocs/demoLaravel/learnlaravel/lara-s-cms-master/app/Http/Controllers'.$name, "haaaaaa");
        // Storage::disk('local')->put("App/Http/Controllers/{$name}",  "haha");
    }


    public function getMenu()
    {
        $this->create_file("name");
        $menu = new \App\Models\Menu;
        $menuList = $menu->tree();

        return view('menu.index')->with('menulist', $menuList);
    }

    public function list()
    {

        $menulist = Menu::all();
        $controllers = DynController::all();
        // $data = [
        //     'menuList'  => $menuList,
        //     'controllers'   => $controllers
        // ];
        return view('menu.list',compact('menulist', 'controllers'));
    }

    public function do_create(Request $request){
        // SAVE THE DATA to functions
        $fn = new functions();
        $fn->function_name = $request->function;
        $fn->type = $request->function_type;
        $fn->controller_id = $request->controller_id;
        $fn->save();
        $fn_id = $fn->id;

         // SAVE THE DATA to menu
         $data = new Menu();
         $data->menu_title = $request->title;
         $data->parent_id = $request->parent_id;
         $data->sort_order = 1;
         $data->controller_id = $request->controller_id;
         $data->function_id = $fn_id;
         $data->slug = "/" . strtolower($data->menu_title);

         if ($data->save()) {
             return redirect()
                 ->route('admin.showmenu')
                 ->with('success', lang('Successfully added a new #item : #name', $this->translation));
         }
         // FAILED
         return back()
             ->withInput()
             ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));
    }

    public function add_controller()
    {
        return view('menu.add_controller');
    }

    public function create_controller(Request $request){

        $this->create_file($request->controller_name);

           // SAVE THE DATA to controller
        $fn = new DynController();
        $fn->controller_name = $request->controller_name;
        $fn->save();

        $menu = new \App\Models\Menu;
        $menuList = $menu->tree();
        return view('menu.index')->with('menulist', $menuList);
    }


}
