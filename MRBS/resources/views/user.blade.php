@extends('layouts.app')
@section('customcss')
<style type="text/css">
	.card .table tbody td:last-child, .card .table thead th:last-child {
		padding-right: 15px;
		display: table-cell;
	}
</style>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover">
				<div class="card-header ">
					<h4 class="card-title">User Maintenance</h4>
					<button class="btn btn-info btn-fill" data-toggle='modal' data-target='.add_user'>Add Employee</button>
				</div>
				<div class="card-body table-full-width table-responsive">
					<table id="sched_today" class="table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Employee No.</th>
							<th>Employee Name</th>
							<th>Role</th>
							<th>Email Address</th>
							<th>Created By</th>
							<th>Date Added</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($userlist as $key => $user)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$user->username}}</td>
								<td>{{$user->name}}</td>
								<td>{{role($user->role)}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->created_by}}</td>
								<td>{{date('F d,Y',strtotime($user->created_at))}}</td>
								<td><button class="btn btn-info btn-fill btn-view" data-id="{{$user->id}}">View</button></td>
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
<div class="modal fade add_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="save_account">
				{{ csrf_field() }}
				<div class="modal-header">
					<h4 class="modal-title">Add new account</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 px-1">
							<div class="form-group">
								<label>Employee ID</label>
								<input type="text" class="form-control" name="username">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 px-1">
							<label>Full Name</label>
							<input type="text" class="form-control" name="name">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 px-1">
							<label>Email Address</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="col-md-6 px-1">
							<label>Select Role</label>
							<select class="form-control" name="role">
								<option selected disabled>Select Role</option>
								<option value="3">IT Admin</option>
								<option value="2">GA Account</option>
								<option value="1">General User</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary save_act">Save Account</button>
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
		$('.save_act').click(function(e) {
			e.preventDefault();
			var data = $('#save_account').serialize();
			$.ajax({
				type: 'POST',
				url:"{{route('addaccount')}}",
				data:data,
				dataType:'json',
				beforeSend:function() {
                    $('.save_act').prop('disabled',true);
                },
				success:function(response) {
					if(response.error){
						$.each(response.message, function(index,value){
							toastr.error(value, 'User Maintenance');
						});
					}
					else{
						toastr.success(response.message, 'User Maintenance');
						setTimeout(function(){window.location.href="{{route('usermain')}}"} , 2000);
					}

				},
				complete:function() {
                    $('.save_act').prop('disabled',false);
                }
			});
		});
	</script>
	@stop
