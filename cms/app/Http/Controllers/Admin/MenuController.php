<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

// LIBRARIES
use App\Libraries\Helper;

// MODELS
use App\Models\Menu;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menu = new \App\Models\Menu;
        $menuList = $menu->tree();
        return view('menu.index')->with('menulist', $menuList);
    }

    public function list()
    {

        $menuList = Menu::all();
        return view('menu.list')->with('menulist', $menuList);
    }

    public function do_create(Request $request){
         // AUTHORIZING...
        //  $authorize = Helper::authorizing($this->module, 'Add New');
        //  if ($authorize['status'] != 'true') {
        //      return back()->with('error', $authorize['message']);
        //  }

         // LARAVEL VALIDATION
        //  $validation = [
        //      'title' => 'required',
        //      'controller' => 'required',
        //      'function' => 'required',
        //      'slug' => 'required',
        //  ];
        //  $message = [
        //      'required' => ':attribute ' . lang('field is required', $this->translation)
        //     //  'unique' => ':attribute ' . lang('has already been taken, please input another data', $this->translation)
        //  ];

        //  $this->validate($request, $validation);

         // SAVE THE DATA
         $data = new Menu();
         $data->menu_title = $request->title;
         $data->controller_name = $request->controller;
         $data->function_name = $request->function;
         $data->slug = $request->slug;



         $data->parent_id = $request->parent_id;
         $data->sort_order = 1;
        //  dd($request);
        //  dd($data);

         if ($data->save()) {
            //  // SUCCESS
             return redirect()
                 ->route('admin.showmenu')
                 ->with('success', lang('Successfully added a new #item : #name', $this->translation));
            // return ('success');
         }

         // FAILED
         return back()
             ->withInput()
             ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));
         return 'failure';
    }



}
