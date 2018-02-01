<?php
	$general_update_time_active = "";
	if(isset($settings['general_update_time_active']) || $settings['general_update_time_active'] == '1')
		$general_update_time_active = "checked";
	$general_update_time = 20;
	if(isset($settings['general_update_time']))
		$general_update_time = $settings['general_update_time'];
	$roomstatus_update_time = 120;
	if(isset($settings['roomstatus_update_time']))
		$roomstatus_update_time = $settings['roomstatus_update_time'];
?>
<div id="general-settings" class="ui bottom attached tab segment active" data-tab="tab-general">
	<form id="general-settings-form" class="ui form">
		<h4 class="ui dividing header">Configuración Página Principal</h4>
		<div class="fields">
			<div class="field">
				<label>Tiempo de actualización (Segundos)</label>
				<div class="ui input corner labeled">
					<input class="seconds_time" placeholder="Tiempo" type="number" name="general_update_time" min="1" max="60" value="<?= $general_update_time ?>">
					<div class="ui corner label">
						<i class="wait icon"></i>
					</div>
				</div>
			</div>
			<div class="field">
				<label>Tiempo de actualización Room Status (Segundos)</label>
				<div class="ui input corner labeled">
					<input class="seconds_time" placeholder="Tiempo" type="number" name="roomstatus_update_time" min="1" max="1000" value="<?= $roomstatus_update_time ?>">
					<div class="ui corner label">
						<i class="wait icon"></i>
					</div>
				</div>
			</div>
		</div>
		<button id="save_general_settings" class="ui primary button">Guardar</button>
	</form>
</div>