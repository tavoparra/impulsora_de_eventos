@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clientes</div>
                <div class="panel-body">
                <table id="usersTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th class="hidden-xs">RFC</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td><a href={{ url('clients/'.$client->id) }}>{{ $client->id }}</a></td>
                            <td><a href={{ url('clients/'.$client->id) }}>{{ $client->name }}</a></td>
                            <td class="hidden-xs"><a href={{ url('clients/'.$client->id) }}>{{ $client->rfc }}</a></td>
                            <td><a href={{ url('users/'.$client->id) }}>{{ $client->status }}</a></td>
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
	$('#usersTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
