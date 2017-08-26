@extends('layouts.app')

@section('content')
<script type="text/javascript" src="/js/packages.js"></script>
<link href="/css/packages.css" rel="stylesheet" />
<div class="container">
    <div class="row">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>
                <div class="panel-body">
                @if (isset($package))
                    {!! Form::model($package, array('url' => ['packages/save', $package->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) !!}
                @else
                    {!! Form::open(['url' => ['packages/save'], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Nombre', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-7">
                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus')) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'Descripción', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::text('description', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('package_price') ? ' has-error' : '' }}">
                            {!! Form::label('package_price', 'Precio local', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::number('package_price', null, array('class' => 'form-control', 'required' => 'required', 'step' => '.5')) !!}

                                @if ($errors->has('package_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('package_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('foreign_package_price') ? ' has-error' : '' }}">
                            {!! Form::label('foreign_package_price', 'Precio foráneo', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::number('foreign_package_price', null, array('class' => 'form-control', 'required' => 'required', 'step' => '.5')) !!}

                                @if ($errors->has('foreign_package_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foreign_package_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            {!! Form::label('category_id', 'Categoría', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::select('category_id', $category_options, null, ['class' => 'form-control select2']) !!}

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('products', 'Productos', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-7 form-inline">
                                
                                {!! Form::select(null, $product_options, null, ['id' => 'productSelect', 'class' => 'form-control select2 col-md-4']) !!}
                            </div>
                            {!! Form::button('Añadir', array('id' => 'productAddBtn', 'class' => 'btn btn-default')) !!}
                        </div>
                        <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                            <div class="well text-center" style="margin: 10px;">
                                <strong id="noProductsSpan">No se han agregado productos.</strong>
                                <table id="itemsTable">
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th></th>
                                    </tr>
                                    @if (isset($package)) 
                                    @foreach ($package->products as $index => $product)
                                    <tr class="itemRow">
                                        <td><input type="number" name="product[{{ $index }}][qty]" min="1" value="{{ $product->pivot->qty }}"class="input-xsmall" style="" /></td>
                                        <td><input type="hidden" name="product[{{ $index }}][id]" value="{{ $product->id }}" />{{ $product->name }}</td>
                                        <td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                            @if ($errors->has('product'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'Imagen', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::file('image') !!}

                                @if (isset($package))
                                    @if ($package->image != '')
                                        Actual:<br/>
                                        <div>
                                            <a id="imgModalLink" data-image="/images/{{ $package->image }}" data-toggle="modal" data-target="#imageModal">
                                                <img src="/images/thumbnails/{{ $package->image }}" />
                                            </a>
                                        </div>
                                    @else
                                        <div>No existe imagen asignada</div>
                                    @endif
                                @endif

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-froup">
                            <div class="col-md-7 col-md-offset-3">
                            @if (!isset($package))
                                {!! Form::checkbox('published', '1', true) !!}
                            @else
                                {!! Form::checkbox('published', '1') !!}
                            @endif
                                {!! Form::label('published', 'Publicado') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                {!! Form::submit($submitText, array('class' => 'btn btn-primary')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials/image-modal')
@endsection
