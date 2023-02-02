<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'image' => 'required|image',
    //     ]);

    //     $image_path = $request->file('image')->store('image', 'public');

    //     $data = Image::create([
    //         'image' => $image_path,
    //     ]);

    //     session()->flash('success', 'Image Upload successfully');

    //     return redirect()->route('image.index');
    // }
    function store_image(){
        return view('image_store');
   }
    function save_image(Request $request){

        $img_name = 'img_'.time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img/'), $img_name);
        $imagePath = 'img/'.$img_name;

        $crud = new Image();
        $crud->title = $request->title;
        $crud->image =  $imagePath;
        $crud->save();

        // Image::create(['title'=> $title, 'image'=>$imagePath]);
        return redirect('image-list');
   }

    function image_list(){
        $images = Image::all();
        return view('image_list', compact('images'));
   }
}
