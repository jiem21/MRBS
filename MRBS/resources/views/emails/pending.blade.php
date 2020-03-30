<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		html,
            body{
                font-family: Verdana, Geneva, sans-serif;
                color: #000;
                font-size: 12px;
            }
            table{
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
                color: #000;
                padding: 10px;
            } 
	</style>
</head>
<body>
	<h4>Hi {{$GA->name}}</h4>

	<p>Please be inform that this user has a request for a room reservation.</p>

	<table>
            <thead>
                <tr>
                    <td style="width:100px;">Name of Requestor</td>
                    <td>Meeting room</td>
                    <td>Date Reserve</td>
                    <td>Time Start</td>
                    <td>Time End</td>
                    <td>Purpose</td>
                    <td>Contact No.</td>
                </tr>
            </thead>
            <tbody>
                    <tr>
                       <td>{{$booking->name}}</td>
                       <td>{{$booking->room_name}}</td>
                       <td>{{date('F d,Y',strtotime($booking->date_reserve))}}</td>
                       <td>{{date('h:i A',strtotime($booking->time_start))}}</td>
                       <td>{{date('h:i A',strtotime($booking->time_end))}}</td>
                       <td>{{$booking->purpose}}</td>
                       <td>{{$booking->contact_no}}</td>
                    </tr>
            </tbody>
        </table>

        <p>
            Regards,
        </p>
        <p>
            <a href="#">Meeting Room Booking System</a>
        </p>
</body>
</html>