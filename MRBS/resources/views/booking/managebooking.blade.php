@extends('layouts.app')
@section('customcss')
<style type="text/css">
	.card .table tbody td:last-child, .card .table thead th:last-child {
		padding-right: 15px;
		display: table-cell;
	}
	textarea {
		height: 100px !important;
	}
</style>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover">
				<div class="card-header ">
					<h4 class="card-title">List of Pending Reservation</h4>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="tbl_pending" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Name of requestor</th>
							<th>Room Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($pending as $key => $book)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$book->name}}</td>
								<td>{{$book->room_name}}</td>
								<td>{{date('F d,Y',strtotime($book->date_reserve))}}</td>
								<td>{{date('h:i A',strtotime($book->time_start)).' - '.date('h:i A',strtotime($book->time_end))}}</td>
								<td>{{booking_status($book->status)}}</td>
								<td><a class="btn btn-primary" target="_blank" href="{{url('/View-Booking').'/'.$book->id}}"><i class="far fa-eye"></i>View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover">
				<div class="card-header ">
					<h4 class="card-title">List of Approved Reservation</h4>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="tbl_approved" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Name of requestor</th>
							<th>Room Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($approved as $key => $book)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$book->name}}</td>
								<td>{{$book->room_name}}</td>
								<td>{{date('F d,Y',strtotime($book->date_reserve))}}</td>
								<td>{{date('h:i A',strtotime($book->time_start)).' - '.date('h:i A',strtotime($book->time_end))}}</td>
								<td>{{booking_status($book->status)}}</td>
								<td><a class="btn btn-primary" target="_blank" href="{{url('/View-Booking').'/'.$book->id}}"><i class="far fa-eye"></i>View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover">
				<div class="card-header ">
					<h4 class="card-title">List of Disapproved Reservation</h4>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="tbl_disapproved" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Name of requestor</th>
							<th>Room Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($disapproved as $key => $book)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$book->name}}</td>
								<td>{{$book->room_name}}</td>
								<td>{{date('F d,Y',strtotime($book->date_reserve))}}</td>
								<td>{{date('h:i A',strtotime($book->time_start)).' - '.date('h:i A',strtotime($book->time_end))}}</td>
								<td>{{booking_status($book->status)}}</td>
								<td>{{$book->remarks}}</td>
								<td><a class="btn btn-primary" target="_blank" href="{{url('/View-Booking').'/'.$book->id}}"><i class="far fa-eye"></i>View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover">
				<div class="card-header ">
					<h4 class="card-title">List of Cancelled Reservation</h4>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="tbl_cancelled" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Name of requestor</th>
							<th>Room Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Status</th>
							<th>Cancelled Remarks</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($cancelled as $key => $book)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$book->name}}</td>
								<td>{{$book->room_name}}</td>
								<td>{{date('F d,Y',strtotime($book->date_reserve))}}</td>
								<td>{{date('h:i A',strtotime($book->time_start)).' - '.date('h:i A',strtotime($book->time_end))}}</td>
								<td>{{booking_status($book->status)}}</td>
								<td>{{$book->cancellation_remarks}}</td>
								<td><a class="btn btn-primary" target="_blank" href="{{url('/View-Booking').'/'.$book->id}}"><i class="far fa-eye"></i>View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('customjs')
<script type="text/javascript">
	$('#tbl_pending').DataTable();
	$('#tbl_approved').DataTable();
	$('#tbl_disapproved').DataTable();
	$('#tbl_cancelled').DataTable();
</script>
@stop
