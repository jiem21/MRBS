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
					<h4 class="card-title">List of Reservation</h4>
					<button class="btn btn-info btn-fill"  data-toggle="modal" data-target=".reservation">Reserve Meeting Room</button>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="sched_today" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Room Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($list as $key => $book)
							<tr>
								<td>{{$key+1}}</td>
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
</div>

<!-- Add Modal -->
<div class="modal fade reservation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="save_booking">
				{{ csrf_field() }}
				<div class="modal-header">
					<h4 class="modal-title">Meeting Room Book</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 px-1">
							<div class="form-group">
								<label>Purpose</label>
								<textarea class="form-control" name="purpose" required placeholder="Purpose" rows="3"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 px-1">
							<label>Contact No.</label>
							<input type="text" class="form-control" name="contact_no">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 pl-1">
							<div class="form-group">
								<label>Date</label>
								<input name="date_reserve" id="date_reserve" type="text" class="form-control" required placeholder="Date">
								<input type="hidden" name="min_date" id="min_date" value="{{date('m/d/Y',strtotime(Carbon\Carbon::today()))}}">
							</div>
						</div>
						<div class="col-md-6 pr-1">
							<div class="form-group">
								<label>Room</label>
								<select class="form-control" name="room" id="room">
									<option selected disabled>Select Room</option>
									@foreach($room as $r)
									<option value="{{$r->id}}">{{$r->room_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 pl-1">
							<label>Time Start</label>
							<select class="form-control" name="time_start" id="time_start">
								<option selected disabled>Select Time start</option>
								<option class="used">Select Time start</option>
							</select>
						</div>
						<div class="col-md-6 pr-1">
							<label>Time End</label>
							<select class="form-control" name="time_end" id="time_end">
								<option selected disabled>Select Time end</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary room_booking">BOOK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End modal -->
@endsection

@section('customjs')
<script type="text/javascript">
	var	date1 = $('#min_date').val();
	$('#sched_today').DataTable();
	$('#date_reserve').datepicker({minDate:date1});

	$('#date_reserve').on('change',function() {
		$('#room').prop('selectedIndex',0);
		$('#time_start').prop('selectedIndex',0);
		$('#time_start .used').remove();
		$('#time_end').prop('selectedIndex',0);
		$('#time_end .used').remove();
	});

	$('#room').on('change',function() {
		$('#time_end').prop('selectedIndex',0);
		$('#time_end .used').remove();
		$('#time_start').prop('selectedIndex',0);
		$('#time_start .used').remove();
		var	date = $('#date_reserve').val();
		var room = $(this).val();
		$.ajax({
			type: 'get',
			url:"{{route('checksttime')}}",
			data:{date:date,room:room},
			success:function(response) {
				$('#time_start .used').remove();
				$('#time_start').append(response);
			}
		});
	});
	$('#time_start').on('change',function() {
		var time = $(this).val();
		$.ajax({
			type: 'get',
			url:"{{route('getendtime')}}",
			data:{time:time},
			success:function(response) {
				$('#time_end .used').remove();
				$('#time_end').append(response);
			}
		});
	})

	$('.room_booking').click(function(event) {
		event.preventDefault();
		var data = $('#save_booking').serialize();
		$.ajax({
				type: 'POST',
				url:"{{route('mrbooking')}}",
				data:data,
				dataType:'json',
				beforeSend:function() {
                    $('.room_booking').prop('disabled',true);
                },
				success:function(response) {
					if(response.error){
						$.each(response.message, function(index,value){
							toastr.error(value, 'Booking');
						});
					}
					else{
						toastr.success(response.message, 'Booking');
						setTimeout(function(){window.location.href="{{route('booking')}}"} , 2000);
					}

				},
				complete:function() {
                    $('.room_booking').prop('disabled',false);
                }
			});
	})
</script>
@stop
