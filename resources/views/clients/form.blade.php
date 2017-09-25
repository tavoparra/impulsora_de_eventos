@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>
                <div class="panel-body">
                @if (isset($client))
                    {!! Form::model($client, array('url' => ['clients/save', $client->id], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @else
                    {!! Form::open(array('url' => ['clients/save'], 'class' => 'form-horizontal', 'role' => 'form')) !!}
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

                        <div class="row">
                            {!! Form::label('', 'Direcciones', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                <div id="address-list">
                                    <div id="no-address-div">No se ha definido ninguna dirección</div>
                                    @if (isset($client))
                                    @foreach ($client->addresses as $index => $address)
                                        <div id="address-panel-{{ $index }}" class="panel panel-info address-panel">
                                            <div class="panel-heading">
                                                <a href="#address-detail-{{ $index }}" data-toggle="collapse" aria-expanded="true">
                                                    <h3 class="panel-title">{{ $address->address_name }}</h3>
                                                </a>
                                                <input name="addresses[{{ $index }}][client_id]" value="{{ $address->client_id }}" type="hidden">
                                                <input name="addresses[{{ $index }}][address_name]" value="{{ $address->address_name }}" type="hidden">
                                                <input name="addresses[{{ $index }}][address]" value="{{ $address->address }}" type="hidden">
                                                <input name="addresses[{{ $index }}][street]" value="{{ $address->street }}" type="hidden">
                                                <input name="addresses[{{ $index }}][number]" value="{{ $address->number }}" type="hidden">
                                                <input name="addresses[{{ $index }}][colony]" value="{{ $address->colony }}" type="hidden">
                                                <input name="addresses[{{ $index }}][city]" value="{{ $address->city }}" type="hidden">
                                                <input name="addresses[{{ $index }}][state]" value="{{ $address->state }}" type="hidden">
                                                <input name="addresses[{{ $index }}][zip]" value="{{ $address->zip }}" type="hidden">
                                                <input name="addresses[{{ $index }}][lat]" value="{{ $address->lat }}" type="hidden">
                                                <input name="addresses[{{ $index }}][long]" value="{{ $address->long }}" type="hidden">
                                            </div>
                                            <div class="panel-body panel-collapse collapse" id="address-detail-{{ $index }}" aria-expanded="true" style="">
                                                Calle: {{ $address->street }} #{{ $address->number }}<br>
                                                Col.: {{ $address->colony }}<br>
                                                León. {{ $address->city }}<br>
                                                C.P.: {{ $address->zip }}
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                                    <a id="addAddressBtn" data-toggle="modal" data-target="#addressModal" class="btn btn-primary">
                                        Agregar dirección
                                    </a>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Correo eléctronico', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', null, array('class' => 'form-control', 'maxlength' => '100')) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        {!! Form::label('phone', 'Teléfono', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                            {!! Form::text('phone', null, array('class' => 'form-control')) !!}

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {!! Form::label('status', 'Status', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::select('status', $status_list, null, ['class' => 'form-control']) !!}

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            {!! Form::label('comments', 'Observaciones', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::textarea('comments', null, array('class' => 'form-control', 'rows' => '4')) !!}

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <h3 class="col-md-12 text-center">
                                <a data-toggle="collapse" href="#rfc-info">
                                    <span class="label label-default">Información de facturación</span>
                                </a>
                            </h3>
                        </div>

                        <div class="collapse {{ isset($client) && (count($client->rfc) > 0) ? 'in' : '' }} " id="rfc-info">
                            <div class="form-group{{ $errors->has('rfc.rfc') ? ' has-error' : '' }}">
                            {!! Form::label('rfc[rfc]', 'R.F.C.', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                {!! Form::text('rfc[rfc]', null, array('class' => 'form-control', 'max-length' => '14', 'pattern' => '^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$')) !!}

                                    @if ($errors->has('rfc.rfc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rfc.rfc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rfc.name') ? ' has-error' : '' }}">
                            {!! Form::label('rfc[name]', 'Nombre o razón social', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                {!! Form::text('rfc[name]', null, array('class' => 'form-control')) !!}

                                    @if ($errors->has('rfc.name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rfc.name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rfc.address') ? ' has-error' : '' }}">
                            {!! Form::label('rfc[name]', 'Dirección', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                {!! Form::textarea('rfc[address]', null, array('class' => 'form-control', 'rows' => '4')) !!}

                                    @if ($errors->has('rfc.address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rfc.address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rfc.email') ? ' has-error' : '' }}">
                                {!! Form::label('rfc.email', 'Correo eléctronico', array('class' => 'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::email('rfc[email]', null, array('class' => 'form-control', 'maxlength' => '100')) !!}

                                    @if ($errors->has('rfc.email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rfc.email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rfc.phone') ? ' has-error' : '' }}">
                            {!! Form::label('rfc.phone', 'Teléfono', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                {!! Form::text('rfc[phone]', null, array('class' => 'form-control')) !!}

                                    @if ($errors->has('rfc.phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rfc.phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
@include('partials/address-modal')
@endsection
@section('page_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places&callback=initAutocomplete" async defer></script>
<script>
	  var placeSearch, autocomplete;
	  var componentForm = {
	     street_number: 'short_name',
	     route: 'long_name',
	     locality: 'long_name',
         sublocality_level_1: 'long_name',
	     administrative_area_level_1: 'long_name',
	     postal_code: 'short_name'
	  }
    
	  function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {componentRestrictions: {country: 'mx'}, appendTo: $("#addressModal")});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

        // Fill the values for the location coordinates
        document.getElementById("latitude").value = place.geometry.location.lat();
        document.getElementById("longitude").value = place.geometry.location.lng();
      }

      $("#addAddressBtn").click(function(){
        $("#address-error").hide();
        $("#autocomplete").val("");
        $("#address_name").val("");
        $(".location-field").val("");
        $("#latitude").val("");
        $("#longitude").val("");
        $("#address_id").val("");
      });


      // If we change the address manually, erase the longitude and latitude
      $(".location-field").change(function() {
        $("#latitude").val("");
        $("#longitude").val("");   
      });

    var pIndex = 0;

    var liTemplate =                   '<div id="address-panel-{COUNTER}" class="panel panel-info address-panel">' +
                                            '<div class="panel-heading">' +
                                            '<a href="#address-detail-{COUNTER}" data-toggle="collapse">' +
                                                '<h3 class="panel-title">{ADDRESS_NAME}</h3>' +
                                            '</a>' +
                                            '<input type="hidden" name="addresses[{COUNTER}][address_name]" value="{ADDRESS_NAME}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][address]" value="{ADDRESS}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][street]" value="{STREET}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][number]" value="{NUMBER}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][colony]" value="{COLONY}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][city]" value="{CITY}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][state]" value="{STATE}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][zip]" value="{ZIP}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][lat]" value="{LATITUDE}" />' +
                                            '<input type="hidden" name="addresses[{COUNTER}][long]" value="{LONGITUDE}" />' +
                                            '</div>' +
                                            '<div class="panel-body panel-collapse collapse" id="address-detail-{COUNTER}">' +
                                                'Calle: {STREET} #{NUMBER}<br/>' +    
                                                'Col.: {COLONY}<br/>' +    
                                                '{CITY}. {STATE}<br/>' +    
                                                'C.P.: {ZIP}' +    
                                            '</div>' +
                                        '</div>';

    var counter = $(".address-panel").length;

    if (counter !== 0) {
        $("#no-address-div").hide();
    } 

    $("#confirmAddAddressBtn").click(function(){
      if ( $(".location-field[value='']").length == 0 && $("#address_name").val() != "") {
          $("#address-error").hide();
          $("#no-address-li").hide();
          var tempLi = liTemplate.replace(/{ADDRESS_NAME}/g, $("#address_name").val());
          tempLi = tempLi.replace(/{ADDRESS}/g, $("#autocomplete").val());
          tempLi = tempLi.replace(/{STREET}/g, $("#route").val());
          tempLi = tempLi.replace(/{NUMBER}/g, $("#street_number").val());
          tempLi = tempLi.replace(/{COLONY}/g, $("#sublocality_level_1").val());
          tempLi = tempLi.replace(/{CITY}/g, $("#locality").val());
          tempLi = tempLi.replace(/{STATE}/g, $("#administrative_area_level_1").val());
          tempLi = tempLi.replace(/{ZIP}/g, $("#postal_code").val());
          tempLi = tempLi.replace(/{LATITUDE}/g, $("#latitude").val());
          tempLi = tempLi.replace(/{LONGITUDE}/g, $("#longitude").val());
          tempLi = tempLi.replace(/{COUNTER}/g, counter);
          $("#address-list").append(tempLi);
           
          counter++;

          $("#addressModal").modal("hide");
      } else {
          $("#address-error").show();
      }
    });
</script>
@endsection
