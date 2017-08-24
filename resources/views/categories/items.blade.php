@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalle de categoría</div>
                <div class="panel-body">
                <h1>Artículos de la categoría: {{ $category->name }}</h1>
                <table id="productsTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->id }}</a></td>
                            <td><a href={{ url('products/') }}>Producto</a></td>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->name }}</a></td>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->description }}</a></td>
                        </tr>
                    @endforeach
                    @foreach ($packages as $package)
                        <tr>
                            <td><a href={{ url('packages/'.$package->id) }}>{{ $package->id }}</a></td>
                            <td><a href={{ url('packages/') }}>Paquete</a></td>
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
<script>
	$('#productsTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
