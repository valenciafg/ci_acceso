<div id="event-type-add-modal" class="ui modal">
	<i class="close icon"></i>
	<div class="header">
		Agregar Tipo de Evento
	</div>
	<div class="content">
		<form id="add-event-type-form" class="ui form">
			<div class="two wide field">
				<label>Codigo</label>
				<div class="ui input">
					<input type="text" name="aet_codigo" value="">
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<label>Descripcion</label>
					<input type="text" name="aet_description" value="">
				</div>
                <div class="six wide field">
					<label>Clasificacion</label>
					<select class="ui fluid search dropdown" name="aet_clasification">
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
					<select class="ui fluid search dropdown" name="aet_departament">
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
		<div class="ui positive right labeled icon button guardar-add-event-type-btn">
			Guardar
			<i class="checkmark icon"></i>
		</div>
	</div>
</div>