<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Http\Response as Res;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{	
	public function __construct(){

    }

    public function loginPage(){
    	return view('/loginpage');
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(),[
    		'email' => 'required|string|email|max:255',
    		'password' => 'required'
    	]);
    	if($validator->fails()){
    		//return response()->json($validator->errors());
            return response()->json([
                        'status' => 'error',
                        'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => $message
                    ]);
    	};
        $user = User::where('email', '=', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Login Fail, please check email id']);
         }
        if (!Hash::check($request->password,$user->password)) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Login Fail, pls check password']);
         }
        
    	return response()->json([
        	'status' => 'success',
        	'status_code' => Res::HTTP_OK,  
            'message'=>'login successful',     	
        ]);
    }
}
