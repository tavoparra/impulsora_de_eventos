@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Categorías</div>
                <div class="panel-body">
                <table id="categoriesTable" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><a href={{ url('categories/'.$category->id) }}>{{ $category->id }}</a></td>
                            <td><a href={{ url('categories/'.$category->id) }}>{{ $category->name }}</a></td>
                            <td><a href={{ url('categories/'.$category->id) }}>{{ $category->description }}</a></td>
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
	$('#categoriesTable').DataTable({
        language: {
            url: '/js/datatables/sp.js'
        }
    });
</script>
@endsection
