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
					<div class="ui right labeled input">
						<input type="text" name="aet_description" id="aet_description" value="" maxlength="38">
						<div id="add-counter-value" class="ui basic label">
							38
  						</div>
					</div>
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
			<div class="fields">
				<div class="six wide field">
					<label for="">Disponibilidad</label>
					<select class="ui fluid search dropdown" name="aet_availability" id="aet_availability">
						<option value="">[Seleccione]</option>
						<?php foreach($availability as $av):?>
						<option value="<?= $av['id'];?>" <?= $av['id']=='1'?'selected':'';?>><?= $av['name'];?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="six wide field">
					<label for="">Estatus de Habitacion</label>
					<select class="ui fluid search dropdown" name="aet_status" id="aet_status">
						<option value="">[Seleccione]</option>
						<?php foreach($status as $st):?>
						<option value="<?= $st['id'];?>" <?= $st['id']=='2'?'selected':'';?>><?= $st['Name'];?></option>
						<?php endforeach;?>
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