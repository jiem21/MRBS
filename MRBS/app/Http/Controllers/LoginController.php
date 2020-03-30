<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

use Hash;
use Validator;
use Redirect;
use Auth;
use DB;
use Session;

class LoginController extends Controller
{
    function __construct()
	{
		$this->user = new User;
	}

	public function authenticate(Request $request)
	{
		$rules = [
			'username'=>'required',
			'password'=>'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json(['error'=>true,'message'=>$validator->messages()]);
		}
		else{
			$user = $this->user->where('username','=',$request->get('username'))->first();
			$check_status = $this->user->where('username','=',$request->get('username'))->where('status','=',2)->count();
			if ($check_status >= 1) {
				return response()->json(['error'=>true,'message'=>['This User is currently deactived']]);
			}
			elseif ($user && Hash::check($request->get('password'), $user->password)) {
				// Auth::login($user);
				Auth::guard()->login($user);
				if (Auth::check()) {
					return response()->json(['error'=>false,'message'=>['Successfully Login']]);
				}
			}
			else{
				return response()->json(['error'=>true,'message'=>['Incorrect Password']]);
			}
		}
	}
}
