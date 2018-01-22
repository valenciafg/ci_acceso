<h3>Consulta de Captahuella</h3>
<form id="schedule-form" class="ui form">
    <div class="fields">
        <div class="field">
            <div class="ui calendar start-date">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="start_date" name="start_date" type="text" placeholder="Fecha Inicio">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar start-time">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="start_time" name="start_time" type="text" placeholder="Hora Inicio">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar end-date">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="end_date" name="end_date" type="text" placeholder="Fecha Fin">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar end-time">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="end_time" name="end_time" type="text" placeholder="Hora Fin">
                </div>
            </div>
        </div>
        <div class="field">
            <select class="ui search dropdown" id="sfootprint-department" name="sfootprint-department">
                <option value="">- Departamento -</option>
                <?php 
                foreach($departments as $dp):
                ?>
                <option value="<?= $dp['DEPARTMENT_CODE'];?>"><?= $dp['DEPARTMENT_NAME'];?></option>
                <?php 
                endforeach;
                ?>
            </select>
        </div>
        <div class="field">
            <select class="ui search dropdown" id="sfootprint-employee" name="sfootprint-employee">
                <option value="">- Empleados -</option>
                <?php 
                foreach($employees as $emp):
                ?>
                <option value="<?= $emp['USER_ID'];?>"><?= $emp['FIRST_NAME'].' '.$emp['LAST_NAME'];?></option>
                <?php 
                endforeach;
                ?>
            </select>
        </div>
        <div class="field">
            <div id="search-footprint" class="ui vertical blue animated button" tabindex="0">
                <div class="hidden content">Buscar</div>
                <div class="visible content">
                    <i class="search icon"></i>
                </div>
            </div>
        </div>
    </div>
</form>
