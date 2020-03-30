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
					<h4 class="card-title">Booking</h4>
				</div>
				<div class="card-body table-full-width table-responsive">
					@foreach($booked as $get)
					<div class="row px-1">
						<div class="col-md-3 pr-1">
							<label>Room Owner</label>
							<input type="text" class="form-control" name="" disabled value="{{$get->name}}">
						</div>
						<div class="col-md-3 px-1">
							<label>Room Name</label>
							<input type="text" class="form-control" name="" disabled value="{{$get->room_name}}">
						</div>
						<div class="col-md-3 px-1">
							<label>Date of Reservation</label>
							<input type="text" class="form-control" name="" disabled value="{{date('F d,Y',strtotime($get->date_reserve))}}">
						</div>
						<div class="col-md-3 pl-1">
							<label>Time</label>
							<input type="text" class="form-control" name="" disabled value="{{date('h:i A',strtotime($get->time_start)).' - '.date('h:i A',strtotime($get->time_end))}}">
						</div>
					</div>
					<div class="row px-1">
						<div class="col-md-3 pr-1">
							<label>Contact No.</label>
							<input type="text" class="form-control" name="" disabled value="{{$get->contact_no}}">
						</div>
						<div class="col-md-3 px-1">
							<label>Date Created</label>
							<input type="text" class="form-control" name="" disabled value="{{date('F d,Y',strtotime($get->created_at))}}">
						</div>
						<div class="col-md-3 pl-1">
							<label>Date Transacted</label>
							@if($get->date_transacted != '0000-00-00 00:00:00')
							<input type="text" class="form-control" name="" disabled value="{{date('F d,Y H:i A',strtotime($get->date_transacted))}}">
							@else
							<input type="text" class="form-control" name="" disabled>
							@endif
						</div>
						<div class="col-md-3 pl-1">
							<label>Status</label>
							<input type="text" class="form-control" name="" disabled value="{{booking_status($get->status)}}">
						</div>
					</div>
					<div class="row px-3">
						<div class="col-md-12 px-1">
							<label>Purpose</label>
							<textarea class="form-control" rows="3" disabled>{{$get->purpose}}</textarea>
						</div>
					</div>
					@if(!empty($get->remarks))
					<div class="row px-3">
						<div class="col-md-12 px-1">
							<label>Remarks</label>
							<textarea class="form-control" rows="3" disabled>{{$get->remarks}}</textarea>
						</div>
					</div>
					@endif
					@if(!empty($get->cancellation_remarks))
					<div class="row px-3">
						<div class="col-md-4">
							<label>Date of Cancellation</label>
							<input type="text" class="form-control" value="{{date('F d,Y H:i A',strtotime($get->date_cancellation))}}" disabled>
						</div>
						<div class="col-md-12 px-1">
							<label>Cancellation Remarks</label>
							<textarea class="form-control" rows="3" disabled>{{$get->cancellation_remarks}}</textarea>
						</div>
					</div>
					@endif
					<div class="row px-1 pt-4">
						@if((Auth::user()->id == $get->reserved_by OR Auth::user()->id == 2) AND ($get->status == 1) AND ($get->date_reserve >= $today AND $get->time_start > $curr_time))
						<div class="col-md-4">
							<button class="btn btn-danger btn-fill btn-cancellation" data-toggle="modal" data-target=".cancellation" data-id="{{$get->id}}">Cancel Reservation</button>
						</div>
						@elseif(Auth::user()->role == 2 and $get->status == 0 AND $get->date_reserve >= $today and $get->time_start > $curr_time)
						<div class="col-md-3">
							<button class="btn btn-success btn-fill" id="approved" data-id="{{$get->id}}">Approve Reservation</button>
						</div>	
						<div class="col-md-3">
							<button class="btn btn-danger btn-fill btn-remarks" data-id="{{$get->id}}" data-toggle="modal" data-target=".remarks">Disapprove Reservation</button>
						</div>
						@else
						@endif
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Remarks Modal -->
<div class="modal fade remarks" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="disapproved_content">
				{{ csrf_field() }}
				<div class="modal-header">
					<h5 class="modal-title">Reason for disapproving this Request</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 px-1">
							<div class="form-group">
								<textarea class="form-control" name="reasons" required placeholder="Remarks" rows="10"></textarea>
								<input type="hidden" name="booking_id" id="booking_id">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary saveremarks">Proceed</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end -->
<!-- cancellation Modal -->
<div class="modal fade cancellation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="cancel_content">
				{{ csrf_field() }}
				<div class="modal-header">
					<h5 class="modal-title">Reason for Cancellation of reservation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 px-1">
							<div class="form-group">
								<textarea class="form-control" name="reasons" required placeholder="Remarks" rows="10"></textarea>
								<input type="hidden" name="cancel_booking_id" id="cancel_booking_id">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary savecancel">Proceed</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end -->
@endsection
@section('customjs')
<script type="text/javascript">
	$('#approved').click(function() {
		var id = $(this).data('id');
		$.ajax({
			type: 'get',
			url:"{{route('appbooking')}}",
			data:{id:id},
			beforeSend:function() {
				$('#approved').prop('disabled',true);
			},
			success:function(response) {
				if(response.error){
					$.each(response.message, function(index,value){
						toastr.error(value, 'Approval');
					});
				}
				else{
					toastr.success(response.message, 'Approval');
					window.setTimeout(function(){location.reload()},1000);
				}

			},
			complete:function() {
				$('#approved').prop('disabled',false);
			}
		});
	});

	$('.btn-remarks').on('click',function() {
		var id = $(this).data('id');
		$('#booking_id').val(id);
	});

	$('.saveremarks').on('click',function(e) {
		e.preventDefault();
		var data = $('#disapproved_content').serialize();
		$.ajax({
			type:'POST',
			url:"{{  route('disappbooking') }}",
			data:data,
			beforeSend:function() {
				$('.saveremarks').prop('disabled',true);
			},
			success:function(data) {
				$.each(data.message, function(index,value){
					if(data.error){
						toastr.error(value, 'For Approval');
						console.log(value);
					}else{
						toastr.success(value, 'For Approval');
						window.setTimeout(function(){location.reload()},1000)
					}
				});
			},
			complete:function(){
				$('.saveremarks').prop('disabled',false);
			}
		});
	});

	$('.btn-cancellation').on('click',function() {
		var id = $(this).data('id');
		$('#cancel_booking_id').val(id);
	});

	$('.savecancel').on('click',function(e) {
		e.preventDefault();
		var data = $('#cancel_content').serialize();
		$.ajax({
			type:'POST',
			url:"{{  route('cancelbooking') }}",
			data:data,
			beforeSend:function() {
				$('.savecancel').prop('disabled',true);
			},
			success:function(data) {
				$.each(data.message, function(index,value){
					if(data.error){
						toastr.error(value, 'For Approval');
						console.log(value);
					}else{
						toastr.success(value, 'For Approval');
						window.setTimeout(function(){location.reload()},1000)
					}
				});
			},
			complete:function(){
				$('.savecancel').prop('disabled',false);
			}
		});
	});
</script>
@stop
