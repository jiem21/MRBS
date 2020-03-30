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
        <div class="col-md-4">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Active Rooms</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table id="act_room" class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>Room Name</th>
                        </thead>
                        <tbody>
                            @foreach($room as $key => $r)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$r->room_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <div class="col-md-8">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Today's Schedule</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table id="sched_today" class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>Room Name</th>
                            <th>Time</th>
                            <th>Booked By</th>
                        </thead>
                        <tbody>
                            @foreach($booked as $key2 => $book)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$book->room_name}}</td>
                                <td>{{date("h:i A",strtotime($book->time_start)).' - '.date("h:i A",strtotime($book->time_end))}}</td>
                                <td>{{$book->name}}</td>
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
        $('#act_room').DataTable();
        $('#sched_today').DataTable();
    </script>
@stop
