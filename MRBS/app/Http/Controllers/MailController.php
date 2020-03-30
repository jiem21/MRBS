<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Booking;
use Mail;
use DB;

class MailController extends Controller
{
    function __construct()
    {
    	$this->user = New User;
    	$this->booking = New Booking;
    }
    public function first_book($booked_id)
    {
    	$mailer_info = $this->user->where('role','=',2)->first();
		$data['GA'] = $this->user->where('role','=',2)->first();
		$data['booking'] = $this->booking->select('booking.*','b.name','c.room_name')->leftjoin('users as b','booking.reserved_by','=','b.id')->leftjoin('rooms as c','booking.room_id','=','c.id')->where('booking.id','=',$booked_id)->first();
		Mail::send('emails.firstbook', $data, function($message) use ($mailer_info){
            $message->to($mailer_info->email)->subject('Meeting Room Booking First Reserve');
        });
    }
    public function pending($booked_id)
    {
    	$mailer_info = $this->user->where('role','=',2)->first();
		$data['GA'] = $this->user->where('role','=',2)->first();
		$data['booking'] = $this->booking->select('booking.*','b.name','c.room_name')->leftjoin('users as b','booking.reserved_by','=','b.id')->leftjoin('rooms as c','booking.room_id','=','c.id')->where('booking.id','=',$booked_id)->first();
		Mail::send('emails.pending', $data, function($message) use ($mailer_info){
            $message->to($mailer_info->email)->subject('Meeting Room Booking Pending Reservation');
        });
    }
    public function approved($req_id,$booked_id)
    {
    	$mailer_info = $this->user->where('id','=',$req_id)->first();
		$data['GA'] = $this->user->where('id','=',$req_id)->first();
		$data['booking'] = $this->booking->select('booking.*','b.name','c.room_name')->leftjoin('users as b','booking.reserved_by','=','b.id')->leftjoin('rooms as c','booking.room_id','=','c.id')->where('booking.id','=',$booked_id)->first();
		Mail::send('emails.approved', $data, function($message) use ($mailer_info){
            $message->to($mailer_info->email)->subject('Meeting Room Booking Approved Reservation');
        });
    }
    public function disapproved($req_id,$booked_id)
    {
    	$mailer_info = $this->user->where('id','=',$req_id)->first();
		$data['GA'] = $this->user->where('id','=',$req_id)->first();
		$data['booking'] = $this->booking->select('booking.*','b.name','c.room_name')->leftjoin('users as b','booking.reserved_by','=','b.id')->leftjoin('rooms as c','booking.room_id','=','c.id')->where('booking.id','=',$booked_id)->first();
		Mail::send('emails.disapproved', $data, function($message) use ($mailer_info){
            $message->to($mailer_info->email)->subject('Meeting Room Booking Disapproved Reservation');
        });
    }
    public function cancelled($booked_id)
    {
    	$mailer_info = $this->user->where('role','=',2)->first();
		$data['GA'] = $this->user->where('role','=',2)->first();
		$data['booking'] = $this->booking->select('booking.*','b.name','c.room_name')->leftjoin('users as b','booking.reserved_by','=','b.id')->leftjoin('rooms as c','booking.room_id','=','c.id')->where('booking.id','=',$booked_id)->first();
		Mail::send('emails.cancelledbook', $data, function($message) use ($mailer_info){
            $message->to($mailer_info->email)->subject('Meeting Room Cancelled Reservation');
        });
    }
}
