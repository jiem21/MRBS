<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use DB;
use Validator;
use Hash;
use Auth;
use Carbon;

class UserController extends Controller
{
    function __construct()
    {
    	$this->user = new User;
    }
    public function index()
    {
    	$data['title'] = 'User Maintenance';
    	$data['userlist'] = $this->user->get();
    	return view('user',$data);
    }
    public function addaccount(Request $req)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required',
            'role' => 'required'
        ];
        $validator = Validator::make($req->all(),$rules);
        if ($validator->fails()) {
            return response()->json(['error'=>true,'message'=>$validator->messages()]);
        }
        else{
            $this->user->insert([
                'name' => $req->get('name'),
                'email' => $req->get('email'),
                'username' => $req->get('username'),
                'password' => bcrypt($req->get('username')),
                'role' => $req->get('role'),
                'status' =>  1,
                'created_at' => Carbon\Carbon::now(),
                'created_by' => Auth::user()->name
            ]);
            return response()->json(['error'=>false,'message'=>['New Account is successfully saved']]);
        }
    }
}
