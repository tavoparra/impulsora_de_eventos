<!-- Modal -->
<div id="addressModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar dirección</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="address-error">
            Favor de llenar todos los campos
        </div>
	    <div class="row form-horizontal">
            <div class="col-md-12">
                <input type="text" id="autocomplete" class="form-control"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Nombre:</label>
            <div class="col-md-8">
                <input type="text" id="address_name" class="form-control" placeholder="Nombre para identificar la dirección"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Calle:</label>
            <div class="col-md-8">
                <input type="text" id="route" class="form-control location-field"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Número:</label>
            <div class="col-md-8">
                <input type="text" id="street_number" class="form-control location-field"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Colonia:</label>
            <div class="col-md-8">
                <input type="text" id="sublocality_level_1" class="form-control location-field"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Ciudad:</label>
            <div class="col-md-8">
                <input type="text" id="locality" class="form-control location-field"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Estado:</label>
            <div class="col-md-8">
                <input type="text" id="administrative_area_level_1" class="form-control location-field"/>
            </div>
        </div>

	    <div class="row form-horizontal">
            <label class="col-md-4 control-label">Código Postal:</label>
            <div class="col-md-8">
                <input type="text" id="postal_code" class="form-control location-field"/>
            </div>
        </div>

        <input type="hidden" id="address_id" />
        <input type="hidden" id="latitude" />
        <input type="hidden" id="longitude" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="confirmAddAddressBtn" class="btn btn-primary">Agregar</button>
      </div>
    </div>

  </div>
</div>
