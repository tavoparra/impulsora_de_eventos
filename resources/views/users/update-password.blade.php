@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Actualizar contraseña</div>
                @if ($message !== '')
                <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif
                <div class="panel-body">
                    {!! Form::open(array('url' => ['user/update-password'], 'class' => 'form-horizontal', 'role' => 'form')) !!}

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            {!! Form::label('new_password', 'Nueva contraseña', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::password('new_password', array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('new_password_confirmation', 'Confirmar', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::password('new_password_confirmation', array('class' => 'form-control', 'required' => 'required')) !!}
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
