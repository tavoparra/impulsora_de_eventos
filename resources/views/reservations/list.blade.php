@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reservaciones</div>
                <div class="panel-body">
                <table id="packagesTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Location</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td><a href={{ url('reservations/'.$reservation->id) }}>{{ $reservation->date }}</a></td>
                            <td><a href={{ url('reservations/'.$reservation->id) }}>{{ $reservation->location }}</a></td>
                            <td><a href={{ url('reservations/'.$reservation->id) }}>{!! nl2br($reservation->customer) !!}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('#packagesTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
