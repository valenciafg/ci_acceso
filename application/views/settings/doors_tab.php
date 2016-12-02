<div id="door-settings" class="ui bottom attached tab segment" data-tab="tab-doors">
	<form id="door-settings-form" class="ui form">
		<h4 class="ui dividing header">Configuración de Módulo de Puertas</h4>
		<div class="fields">
			<div class="field">
				<label>Tiempo de actualización (Segundos)</label>
				<div class="ui input corner labeled">
					<input class="seconds_time" placeholder="Tiempo" type="number" name="doors_update_time" min="1" max="60">
					<div class="ui corner label">
						<i class="wait icon"></i>
					</div>
				</div>
			</div>
		</div>
		<button id="save_door_settings" class="ui primary button">Guardar</button>
	</form>
</div>