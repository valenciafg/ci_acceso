<div id="event-type-edit-modal" class="ui modal">
	<i class="close icon"></i>
	<div class="header">
		Editar Tipo de Evento
	</div>
	<div class="content">
		<form id="edit-event-type-form" class="ui form">
			<input type="hidden" name="eet_id" value=""/>
			<div class="two wide field">
				<label>Codigo</label>
				<div class="ui input disabled">
					<input type="text" name="eet_codigo" value="" readonly>
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<label>Descripcion</label>
					<div class="ui right labeled input">
						<input type="text" name="eet_description" id="eet_description" value="" maxlength="38">
						<div id="counter-value" class="ui basic label">
  						</div>
					</div>
				</div>
                <div class="six wide field">
					<label>Clasificacion</label>
					<select class="ui fluid search dropdown" name="eet_clasification">
						<option value="">[Seleccione]</option>
                        <option value="1">Status de habitacion</option>
                        <option value="2">General</option>
                        <option value="3">Pintura, Albañileria y Drywall</option>
                        <option value="4">Carpinteria</option>
                        <option value="5">Plomeria</option>
                        <option value="6">Electricidad</option>
                        <option value="7">A/C</option>
                        <option value="8">Sistemas</option>
					</select>
				</div>
                <div class="six wide field">
					<label>Departamento</label>
					<select class="ui fluid search dropdown" name="eet_departament">
						<option value="">[Seleccione]</option>
					</select>
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<label for="">Disponibilidad</label>
					<select class="ui fluid search dropdown" name="eet_availability" id="eet_availability">
						<option value="">[Seleccione]</option>
					</select>
				</div>
				<div class="six wide field">
					<label for="">Estatus de Habitacion</label>
					<select class="ui fluid search dropdown" name="eet_status" id="eet_status">
						<option value="">[Seleccione]</option>
					</select>
				</div>
			</div>
		</form>
	</div>
	<div class="actions">
		<div class="ui black deny button">
			Cancelar
		</div>
		<div class="ui positive right labeled icon button guardar-edit-event-type-btn">
			Guardar
			<i class="checkmark icon"></i>
		</div>
	</div>
</div>