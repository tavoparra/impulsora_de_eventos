@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo usuario</div>
                <div class="panel-body">
                @if (!isset($client))
                    {!! Form::open(array('url' => ['clients/save'], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @else
                    {!! Form::model($client, array('url' => ['clients/save'], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @endif
                        {!! Form::hidden('id') !!}
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

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Nombre de usuario', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::text('username', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Contraseña', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirmar contraseña', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', array('class' => 'form-control', 'required' => 'required')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Crear', array('class' => 'btn btn-primary')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
