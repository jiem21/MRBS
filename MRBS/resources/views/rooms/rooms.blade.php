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
					<h4 class="card-title">List of Rooms</h4>
					<button class="btn btn-info btn-fill"  data-toggle="modal" data-target=".room">Add New Meeting Room</button>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="sched_today" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Room Name</th>
							<th>Date Created</th>
							<th>Created By</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($list as $key => $room)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$room->room_name}}</td>
								<td>{{date('F d,Y',strtotime($room->created_at))}}</td>
								<td>{{$room->created_by}}</td>
								<td>{{room_status($room->room_status)}}</td>
								<td><button class="btn btn-primary btn-fill btn-view" data-id="{{$room->id}}">View</button></td>
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
<div class="modal fade room" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="new_room">
				{{ csrf_field() }}
				<div class="modal-header">
					<h4 class="modal-title">Add New Meeting Room</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 px-1">
							<label>Room Name</label>
							<input name="room_name" type="text" class="form-control" required placeholder="Room Name">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary save_room">Add</button>
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
	$('#sched_today').DataTable();

	$('.save_room').click(function(e) {
		e.preventDefault();
		var data = $('#new_room').serialize();
		$.ajax({
				type: 'POST',
				url:"{{route('rooms-save')}}",
				data:data,
				dataType:'json',
				success:function(response) {

					if(response.error){
						$.each(response.message, function(index,value){
							toastr.error(value, 'Room');
						});
						console.log(response.password);
					}
					else{
						toastr.success(response.message, 'Room');
						setTimeout(function(){window.location.href="{{route('rooms')}}"} , 1500);
					}

				}
			});
	})
</script>
@stop
