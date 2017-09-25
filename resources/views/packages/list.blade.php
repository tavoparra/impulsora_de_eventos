@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Paquetes</div>
                <div class="panel-body">
                <table id="packagesTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td><a href={{ url('packages/'.$package->id) }}>{{ $package->id }}</a></td>
                            <td><a href={{ url('categories/'.$package->category->id.'/items') }}>{{ $package->category->name }}</a></td>
                            <td><a href={{ url('packages/'.$package->id) }}>{{ $package->name }}</a></td>
                            <td><a href={{ url('packages/'.$package->id) }}>{{ $package->description }}</a></td>
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
	$('#packagesTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
