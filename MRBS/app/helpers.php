<?php 
if (! function_exists('booking_status')) {
  function booking_status($status) {
   switch ($status) {
     case 0:
     return 'Pending';
     break;

     case 1:
     return 'Approved';
     break;

     case 2:
     return 'Disapproved';
     break;

     case 3:
     return 'Cancelled Booking';
     break;
     
     default:
     return 'Error Code';
     break;
   }
 }
}

if (! function_exists('role')) {
  function role($role) {
   switch ($role) {
     case 1:
     return 'General User';
     break;

     case 2:
     return 'GA Account';
     break;

     case 3:
     return 'IT Admin';
     break;

     default:
     return 'Error Code';
     break;
   }
 }
}

if (! function_exists('room_status')) {
  function room_status($status) {
   switch ($status) {
     case 1:
     return 'Active';
     break;

     case 2:
     return 'Inactive';
     break;
     
     default:
     return 'Error Code';
     break;
   }
 }
}

?>