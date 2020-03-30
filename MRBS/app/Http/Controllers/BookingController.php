<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Booking;
use App\Room;
use App\Time;
use Auth;
use DB;
use Validator;
use Carbon;

use App\Http\Controllers\MailController;

class BookingController extends Controller
{
	public $output_time = "";
	public $output_time2 = "";
	function __construct()
	{
		$this->booking = New Booking;
		$this->room = New Room;
		$this->time = New Time;
		$this->mail = New MailController;
	}
	public function index()
	{
		$id = Auth::user()->id;
		$data['title'] = 'Booking';
		$data['list'] = $this->booking->select('booking.*','b.room_name')->leftjoin('rooms as b','booking.room_id','=','b.id')->where('booking.reserved_by','=',$id)->orderBy('date_reserve','desc')->get();
		$data['room'] = $this->room->where('room_status','=',1)->orderBy('room_name','asc')->get();
		return view('booking.booking',$data);
	}
	public function check_start_time(Request $request)
	{
		$date = date('Y-m-d',strtotime($request->get('date')));
		$check_date_room = $this->booking->where('date_reserve','=',$date)->where('status','=',1)->where('room_id','=',$request->get('room'))->count();
		if (date('Y-m-d',strtotime(Carbon\Carbon::today())) == $date) {
			if ($check_date_room == 0) {
				$current_time = date("H:i:s",strtotime(Carbon\Carbon::now()));
				$get_time = $this->time->where('Time','>',$current_time)->orderBy('Time','ASC')->get();
				foreach ($get_time as $value) {
					$this->output_time .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
				}
				return $this->output_time;
			}
			else{
				$current_time = date("H:i:s",strtotime(Carbon\Carbon::now()));
				$check_available = $this->booking->where('date_reserve','=',$date)->where('room_id','=',$request->get('room'))->orderBy('Time_end','desc')->first();
				if ($check_available->time_end > $current_time) {
					$get_time = $this->time->where('Time','>=',$check_available->time_end)->get();
					foreach ($get_time as $value) {
						$this->output_time .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
					}
					return $this->output_time;
				}
				else{
					// $current_time = date("H:i:s",strtotime(Carbon\Carbon::now()));
					$get_time = $this->time->where('Time','>',$current_time)->orderBy('Time','ASC')->get();
					foreach ($get_time as $value) {
						$this->output_time .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
					}
					return $this->output_time;
				}
			}
		}
		elseif ($check_date_room == 0) {
			$get_time = $this->time->orderBy('Time','ASC')->get();
			foreach ($get_time as $value) {
				$this->output_time .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
			}
			return $this->output_time;
		}
		else{
			$check_available = $this->booking->where('date_reserve','=',$date)
									->where('room_id','=',$request->get('room'))
									->orderBy('Time_end','desc')->first();
			$get_time = $this->time->where('Time','>=',$check_available->time_end)->get();
			foreach ($get_time as $value) {
				$this->output_time .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
			}
			return $this->output_time;
		}
	}
	public function get_end_time(Request $request)
	{
		$get_time = $this->time->where('Time','>',$request->get('time'))->get();
		foreach ($get_time as $value) {
			$this->output_time2 .= '<option class="used" value="'.$value->Time.'">'.date("h:i A",strtotime($value->Time)).'</option>';
		}
		return $this->output_time2;
	}
	public function save_booking(Request $request)
	{
		$rules = [
			'purpose' => 'required',
			'contact_no' => 'required',
			'date_reserve' => 'required',
			'room' => 'required',
			'time_start' => 'required',
			'time_end' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		$user_id = Auth::user()->id;
		$today = Carbon\Carbon::today();
		$endToday = Carbon\Carbon::today()->settime(23,59,59);
		$check_booked = $this->booking->where('reserved_by','=',$user_id)->whereBetween('created_at',[$today,$endToday])->count();
		$check_same_book = $this->booking->where('date_reserve','=',$request->get('date_reserve'))->where('time_start','=',$request->get('time_start'))->count();
		if ($validator->fails()) {
			return response()->json(['error'=>true,'message'=>$validator->messages()]);
		}
		elseif ($check_same_book == 1) {
			return response()->json(['error'=>true,'message'=>['Someone is already booked on this time.']]);
		}
		elseif($check_booked >= 1){
			$id = $this->booking->insertGetId([
				'date_reserve' => date('Y-m-d',strtotime($request->get('date_reserve'))),
				'time_start' => $request->get('time_start'),
				'time_end' => $request->get('time_end'),
				'room_id' => $request->get('room'),
				'reserved_by' => Auth::user()->id,
				'purpose' => $request->get('purpose'),
				'contact_no' => $request->get('contact_no'),
				'status' => 0,
				'created_at' => Carbon\Carbon::now()
			]);
			$this->mail->pending($id);
			return response()->json(['error'=>false,'message'=>['Successfully book wait for the Apporval of GA']]);
		}
		else{
			$id = $this->booking->insertGetId([
				'date_reserve' => date('Y-m-d',strtotime($request->get('date_reserve'))),
				'time_start' => $request->get('time_start'),
				'time_end' => $request->get('time_end'),
				'room_id' => $request->get('room'),
				'reserved_by' => Auth::user()->id,
				'purpose' => $request->get('purpose'),
				'contact_no' => $request->get('contact_no'),
				'status' => 1,
				'created_at' => Carbon\Carbon::now()
			]);

			$this->mail->first_book($id);
			return response()->json(['error'=>false,'message'=>['Successfully book']]);
		}
		
	}

	public function manage_booking()
	{
		$data['title'] = 'Manage Booking';
		$today = date('Y-m-d',strtotime(Carbon\Carbon::today()));
		$data['pending'] = $this->booking->select('booking.*','b.room_name','c.name')->leftjoin('rooms as b','booking.room_id','=','b.id')->leftjoin('users as c','booking.reserved_by','=','c.id')->where('booking.status','=',0)->where('booking.date_reserve','>=',$today)->orderBy('booking.date_reserve','desc')->get();
		$data['approved'] = $this->booking->select('booking.*','b.room_name','c.name')->leftjoin('rooms as b','booking.room_id','=','b.id')->leftjoin('users as c','booking.reserved_by','=','c.id')->where('booking.status','=',1)->orderBy('booking.date_reserve','desc')->get();
		$data['disapproved'] = $this->booking->select('booking.*','b.room_name','c.name')->leftjoin('rooms as b','booking.room_id','=','b.id')->leftjoin('users as c','booking.reserved_by','=','c.id')->where('booking.status','=',2)->orderBy('booking.date_reserve','desc')->get();
		$data['cancelled'] = $this->booking->select('booking.*','b.room_name','c.name')->leftjoin('rooms as b','booking.room_id','=','b.id')->leftjoin('users as c','booking.reserved_by','=','c.id')->where('booking.status','=',3)->orderBy('booking.date_reserve','desc')->get();
		return view('booking.managebooking',$data);
    }

    public function viewbook($id)
    {
    	$data['id'] = $id;
    	$data['today'] = date('Y-m-d',strtotime(Carbon\Carbon::today()));
    	$data['curr_time'] = date('H:i:s',strtotime(Carbon\Carbon::now()));
    	$data['title'] = 'View Booking';
    	$data['booked'] = $this->booking->select('booking.*','b.room_name','c.name')->leftjoin('rooms as b','booking.room_id','=','b.id')->leftjoin('users as c','booking.reserved_by','=','c.id')->where('booking.id','=',$id)->get();
    	return view('booking.viewbooking',$data);
    }
    public function approved(Request $req)
    {
    	$get = $this->booking->where('id','=',$req->get('id'))->first();
    	$this->booking->where('id','=',$get->id)->update([
    		'status' => 1,
    		'date_transacted' => Carbon\Carbon::now()
    		]);
    	$this->mail->approved($get->reserved_by,$get->id);
    	return response()->json(['error'=>false,'message'=>['Reservation is Successfully approved']]);

    }
    public function disapproved(Request $req)
    {
    	$get = $this->booking->where('id','=',$req->get('booking_id'))->first();
    	$this->booking->where('id','=',$get->id)->update([
    		'status' => 2,
    		'remarks' => $req->get('reasons'),
    		'date_transacted' => Carbon\Carbon::now()
    	]);
    	$this->mail->disapproved($get->reserved_by,$get->id);
    	return response()->json(['error'=>false,'message'=>['Reservation is Successfully disapproved']]);

    }
    public function cancellation(Request $req)
    {
    	$get = $this->booking->where('id','=',$req->get('cancel_booking_id'))->first();
    	$this->booking->where('id','=',$get->id)->update([
    		'status' => 3,
    		'cancellation_remarks' => $req->get('reasons'),
    		'date_cancellation' => Carbon\Carbon::now()
    		]);
    	$this->mail->cancelled($get->id);
    	return response()->json(['error'=>false,'message'=>['Reservation is Successfully disapproved']]);
    }
}