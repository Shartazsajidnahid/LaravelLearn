<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Product;


class ProductController extends Controller
{
    //

    function index(){
        $prod = Product::all();
        return $prod;
        // return $this->sendResponse($products->toArray(), 'Products retrieved');
    }


    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'about' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->senderror('Validationerror',$validator->errors());
        }

        $prod = Product::create([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return 'Product added succesfully';

    }

    function show($id){
        $prod = Product::find($id);
        if(!is_null($prod))
        {
            return $prod;
        }
        else{
            return 'Product not found';
        }
    }

    function update(Request $request, Product $product){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'about' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->senderror('Validationerror',$validator->errors());
        }

        $product->name = $request->name;
        $product->about = $request->about;

        $product->update();

        return 'Product updated succesfully';

    }

    function destroy(Product $product){
        $product->delete();

        return 'Product deleted';

    }

}
