<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Booking;
use App\Room;
use App\Time;
use Auth;
use DB;
use Validator;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->booking = New Booking;
        $this->room = New Room;
        $this->time = New Time;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['room'] = $this->room->where('room_status','=',1)->orderBy('created_at','asc')->get();
        $data['booked'] = $this->booking->select('booking.*','b.name','c.room_name')
                                ->leftjoin('users as b','booking.reserved_by','=','b.id')
                                ->leftjoin('rooms as c','booking.room_id','=','c.id')
                                ->where('booking.status','=',1)
                                ->where('booking.date_reserve','=',date('Y-m-d',strtotime(Carbon\Carbon::today())))
                                ->orderBy('time_start','asc')->get();
        return view('home',$data);
    }
}
