@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>
                <div class="panel-body">
                <table id="productsTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->id }}</a></td>
                            <td><a href={{ url('categories/'.$product->category->id.'/items') }}>{{ $product->category->name }}</a></td>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->name }}</a></td>
                            <td><a href={{ url('products/'.$product->id) }}>{{ $product->description }}</a></td>
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
	$('#productsTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
