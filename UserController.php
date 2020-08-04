<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response as Res;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function __construct(){

    }

    public function userList(Request $request){
    	return view('/userlist');
    }

    public function fetchUserlist(Request $request){
    	$data = app('App\User')->userlisting();
    	return response()->json([
        	'status' => 'success',
        	'status_code' => Res::HTTP_OK,
        	'data'=>$data
        ]); 
    }

    public function userAdd(Request $request){
        return view('/useradd');
    }

    public function addUser(Request $request){
        if($request->u_id > 0){
            $rules = array (
                'name' => 'required|max:191',                    
                'email' => 'required|unique:user,email,'.$request->u_id,       
            );
            $validator = Validator::make($request->all(), $rules);
            $messages = $validator->messages();
            if ($validator-> fails()){
                //return response()->json($validator->messages(), 200); 
                foreach ($messages->all() as $message)
                {
                    return response()->json([
                        'status' => 'error',
                        'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => $message
                    ]);
                }                 
            }
            $data = User::where('id',$request->u_id)
                    ->update([ 
                        'name' => trim(ucfirst($request->input('name'))),                
                        'email' => trim($request->input('email'))
                    ]);
            if(count((array)$data)>0){
                return response()->json([
                'status' => 'success',
                'status_code'=> Res::HTTP_OK,
                'message' => 'User Updated',
              ]);
            }
        }else{
        $rules = array (
                'name' => 'required|max:191',
                'email' => 'required|email|max:191|unique:user',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
                );
        $validator = Validator::make($request->all(), $rules);
            $messages = $validator->messages();
            if ($validator-> fails()){
                //return response()->json($validator->messages(), 200); 
                foreach ($messages->all() as $message)
                {
                    return response()->json([
                        'status' => 'error',
                        'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => $message
                    ]);
                }                
            }  
            $pw = Hash::make(trim($request->input('password'))); 
            $data = User::insertGetId([ 
                        'name' => trim(ucfirst($request->input('name'))),
                        'email' => trim($request->input('email')),
                        'password' => trim($pw)
                    ]);
            if(count((array)$data)>0){
                return response()->json([
                'status' => 'success',
                'status_code'=> Res::HTTP_OK,
                'message' => 'User Inserted',
              ]);
            }
        }
    }

    public function userEdit($id){
        $data = app('App\User')->singleuser($id);//echo'<pre/>';print_r($data);exit;
        return view('/useredit')->with('data',$data)->with('id',$id);
    }
}
