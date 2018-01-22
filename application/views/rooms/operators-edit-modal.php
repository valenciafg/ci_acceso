<div id="operators-edit-modal" class="ui modal">
	<i class="close icon"></i>
	<div class="header">
		Editar Operador
	</div>
	<div class="content">
		<form id="edit-operator-form" class="ui form">
			<div class="two wide field">
				<label>Codigo</label>
				<div class="ui disabled input">
					<input type="text" name="codigo" value="" readonly>
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<label>Departamento</label>
					<select class="ui fluid search dropdown" name="departamento">
						<option value="">[Seleccione]</option>
					</select>
				</div>
				<div class="six wide field">
					<label>Nombre</label>
					<input type="text" name="nombre" value="">
				</div>
			</div>
			<div class="inline fields">
				<label>Activo:</label>
				<div class="field">
					<div class="ui radio checkbox">
						<input type="radio" name="estatus" value="1">
						<label>Sí</label>
					</div>
				</div>
				<div class="field">
					<div class="ui radio checkbox">
						<input type="radio" name="estatus" value="0">
						<label>No</label>
					</div>
				</div>
			</div>
			<input type="hidden" name="id" value="">
		</form>
	</div>
	<div class="actions">
		<div class="ui black deny button">
			Cancelar
		</div>
		<div class="ui positive right labeled icon button guardar-edit-operator-btn">
			Guardar
			<i class="checkmark icon"></i>
		</div>
	</div>
</div>