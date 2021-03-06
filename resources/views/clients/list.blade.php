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
                            <th class="hidden-xs">E-mail</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td><a href={{ url('clients/'.$client->id) }}>{{ $client->id }}</a></td>
                            <td><a href={{ url('clients/'.$client->id) }}>{{ $client->name }}</a></td>
                            <td class="hidden-xs"><a href={{ url('clients/'.$client->id) }}>{{ $client->email }}</a></td>
                            <td>{{ $client->status }}</td>
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
@section('page_scripts')
<script>
	$('#usersTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
