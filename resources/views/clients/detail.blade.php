@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalle de Cliente</div>
                <div class="panel-body">
                    {!! Form::model($cliente, array('url' => ['clients/save', $client->id], 'class' => 'form-horizontal', 'role' => 'form')) !!}
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

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Correo electrónico', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Actualizar', array('class' => 'btn btn-primary')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
