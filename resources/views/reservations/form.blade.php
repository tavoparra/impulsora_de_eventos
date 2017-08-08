@extends('layouts.app')

@section('content')
<script type="text/javascript" src="/js/reservations.js"></script>
<link href="/css/reservations.css" rel="stylesheet" />
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
                @if (isset($reservation))
                    {!! Form::model($reservation, array('url' => ['reservations/save', $reservation->id], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @else
                    {!! Form::open(['url' => ['reservations/save'], 'class' => 'form-horizontal', 'role' => 'form']) !!}
                @endif
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        {!! Form::label('date', 'Fecha', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-7">
                            {!! Form::text('date', null, array('class' => 'form-control', 'required' => 'required', 'id' => 'reservation_date')) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            {!! Form::label('location', 'Ubicación', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::text('location', null, array('class' => 'form-control', 'required' => 'required')) !!}

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('customer') ? ' has-error' : '' }}">
                            {!! Form::label('customer', 'Cliente', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::textarea('customer', null, array('class' => 'form-control', 'required' => 'required', 'rows' => '4')) !!}

                                @if ($errors->has('customer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('products', 'Productos', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-7 form-inline">
                                
                                <select id="productSelect" class="form-control select2 col-md-4">
                                    @foreach ($products as $product)
                                        <option
                                            value="{{ $product->id }}"
                                            data-price="{{ $product->unit_price  }}"
                                            >
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {!! Form::button('Añadir', array('id' => 'productAddBtn', 'class' => 'btn btn-default')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('packages', 'Paquetes', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-7 form-inline">
                                
                                <select id="packageSelect" class="form-control select2 col-md-4">
                                    @foreach ($packages as $package)
                                        <option
                                            value="{{ $package->id }}"
                                            data-price="{{ $package->package_price  }}"
                                            data-content="{{ $package->content  }}"
                                            >
                                            {{ $package->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {!! Form::button('Añadir', array('id' => 'packageAddBtn', 'class' => 'btn btn-default')) !!}
                        </div>

                        <div class="form-group">
                            <div class="well text-center" style="margin: 10px;">
                                <strong id="noProductsSpan">No se han agregado productos.</strong>
                                <table id="itemsTable">
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                    @if (isset($reservation)) 
                                    @foreach ($reservation->packages as $index => $package)
                                    <tr class="itemRow">
                                        <td><input type="number" name="package[{{ $index }}][qty]" min="1" value="{{ $package->pivot->rented_qty }}"class="input-xsmall pQty" /></td>
                                        <td><input type="hidden" name="package[{{ $index }}][id]" value="{{ $package->id }}" />{{ $package->name }}</td>
                                        <td>$<span class="price">{{ $package->package_price }}</span></td>
                                        <td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>
                                    </tr>
                                    @endforeach
                                    @foreach ($reservation->products as $index => $product)
                                    <tr class="itemRow">
                                        <td><input type="number" name="product[{{ $index }}][qty]" min="1" value="{{ $product->pivot->rented_qty }}"class="input-xsmall pQty" /></td>
                                        <td><input type="hidden" name="product[{{ $index }}][id]" value="{{ $product->id }}" />{{ $product->name }}</td>
                                        <td>$<span class="price">{{ $product->unit_price }}</span></td>
                                        <td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                            {!! Form::label('total', 'Total', array('class' => 'col-md-3 control-label')) !!}

                            <div class="col-md-7">
                                {!! Form::text('total', null, array('class' => 'form-control', 'id' => 'total', 'required' => 'required', 'rows' => '4')) !!}

                                @if ($errors->has('total'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
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
    <script type="text/javascript">
        $('#reservation_date').datepicker({
           format: 'yyyy-mm-dd'
         });
    </script>
@endsection
