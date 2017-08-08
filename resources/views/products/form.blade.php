@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>
                <div class="panel-body">
                @if (isset($product))
                    {!! Form::model($product, array('url' => ['products/save', $product->id], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @else
                    {!! Form::open(['url' => ['products/save'], 'class' => 'form-horizontal', 'role' => 'form']) !!}
                @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Nombre', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus')) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'Descripción', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::text('description', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            {!! Form::label('quantity', 'Cantidad disponible', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::number('quantity', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : '' }}">
                            {!! Form::label('unit_price', 'Precio unitario', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::number('unit_price', null, array('class' => 'form-control', 'required' => 'required', 'step' => '.5')) !!}

                                @if ($errors->has('unit_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            {!! Form::label('category_id', 'Categoría', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::select('category_id', $category_options, null, ['class' => 'form-control select2']) !!}

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-froup">
                            <div class="col-md-7 col-md-offset-3">
                            @if (!isset($product))
                                {!! Form::checkbox('published', '1', true) !!}
                            @else
                                {!! Form::checkbox('published', '1') !!}
                            @endif
                                {!! Form::label('published', 'Publicado') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit($submitText, array('class' => 'btn btn-primary')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
