<?php

namespace App\Http\Controllers;
use App\Models\apiuser;
use Illuminate\Http\Request;
use Validator;



class ApiuserController extends Controller
{

    private $rules = [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required|email',
    ];


    public function getAlldata($id=null){
        if($id==null){
            $allData = apiuser::all();
            return $allData;
        }
        else{
            $data = apiuser::find($id);
            return $data;
        }

    }

    public function storedata(Request $request){

        $response = array('response' => '', 'success'=>false);

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }
        else {
            //process the request
            $data = new apiuser();
            $data->name = $request->name;
            $data->password = $request->password;
            $data->email = $request->email;
            $result = $data->save();

            if($result){
                $response['success'] = true;
                $response['response'] = "User created successfully";
            }
            else{
                $response['response'] = "failed to create User";
            }
        }
        return $response;
    }


    public function updatedata(Request $request){
        // return "hey";
        $response = array('response' => '', 'success'=>false);

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }
        else {
            //process the request
            $data = apiuser::find($request->id);
            $data->name = $request->name;
            $data->password = $request->password;
            $data->email = $request->email;
            $result = $data->update();

            if($result){
                $response['success'] = true;
                $response['response'] = "User updated successfully";
            }
            else{
                $response['response'] = "failed to update User";
            }
        }
        return $response;
    }


    public function deletedata($id){
        $response = array('response' => '', 'success'=>false);

        $user = apiuser::find($id);
        $result = $user->delete();

        if($result){
            $response['success'] = true;
            $response['response'] = "User deleted successfully";
        }
        else{
            $response['response'] = "failed to delete User";
        }
        return $response;
    }

    public function search($name){
        return apiuser::where("name","like","%".$name."%")->get();
    }
}
