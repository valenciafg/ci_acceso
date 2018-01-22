<h3>Eventos</h3>
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
            <div class="ui calendar end-date">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="end_date" name="end_date" type="text" placeholder="Fecha Fin">
                </div>
            </div>
        </div>
        <div class="field">
            <select class="ui search dropdown" id="sevent-room" name="sevent-room">
                <option value="">- Habitacion -</option>
                <?php 
                foreach($rooms as $r):
                ?>
                <option value="<?= $r['PhoneNumber'];?>"><?= $r['Name'];?></option>
                <?php 
                endforeach;
                ?>
            </select>
        </div>
        <div class="field">
            <select class="ui search dropdown" id="sfootprint-department" name="sfootprint-department">
                <option value="">- Clasificacion -</option>
                <?php 
                foreach($clasifications as $cl):
                ?>
                <option value="<?= $cl['id'];?>"><?= $cl['description'];?></option>
                <?php 
                endforeach;
                ?>
            </select>
        </div>
        <div class="field">
            <div id="search-room-event" class="ui vertical blue animated button" tabindex="0">
                <div class="hidden content">Buscar</div>
                <div class="visible content">
                    <i class="search icon"></i>
                </div>
            </div>
        </div>
    </div>
</form>
