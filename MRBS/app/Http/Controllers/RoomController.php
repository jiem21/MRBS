<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Booking;
use App\Room;
use Auth;
use DB;
use Validator;
use Carbon;

class RoomController extends Controller
{
	function __construct()
	{
		$this->booking = New Booking;
		$this->room = New Room;
	}
	public function index()
	{
		$id = Auth::user()->id;
		$data['title'] = 'Room Maintenance';
		$data['list'] = $this->room->get();
		return view('rooms.rooms',$data);
	}
	public function save(Request $request)
	{
		$rules = [
			'room_name' => 'required|unique:rooms'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json(['error'=>true,'message'=>$validator->messages()]);
		}
		else{
			try {
				$this->room->insert([
					'room_name'=>$request->get('room_name'),
					'room_status'=>1,
					'created_at'=>Carbon\Carbon::now(),
					'created_by'=>Auth::user()->username
				]);
				return response()->json(['error'=>false,'message'=>['Successfully Saved']]);
			} catch (Exception $e) {
				return response()->json(['error' => true,'message'=>[$e->getMessage()]]);
			}
		}
	}
}
