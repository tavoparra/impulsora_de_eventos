@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>
                <div class="panel-body">
                <table id="usersTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Nombre de usuario</th>
                            <th class="hidden-xs">Correo electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href={{ url('users/'.$user->username) }}>{{ $user->id }}</a></td>
                            <td><a href={{ url('users/'.$user->username) }}>{{ $user->name }}</a></td>
                            <td><a href={{ url('users/'.$user->username) }}>{{ $user->username }}</a></td>
                            <td class="hidden-xs"><a href={{ url('users/'.$user->username) }}>{{ $user->email }}</a></td>
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
