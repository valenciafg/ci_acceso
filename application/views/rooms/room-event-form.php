<h3>Eventos</h3>
<form id="schedule-form" class="ui form">
    <div class="fields">
        <div class="field">
            <div class="ui calendar start-date">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="sevent_start_date" name="sevent_start_date" type="text" placeholder="Fecha Inicio" value="<?= date('d-m-Y',strtotime("-1 day"));?>">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar start-time">
                <div class="ui input left icon">
                    <i class="hourglass empty icon"></i>
                    <input id="sevent_start_time" name="sevent_start_time" type="text" placeholder="Hora Inicio" value="0:00">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar end-date">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="sevent_end_date" name="sevent_end_date" type="text" placeholder="Fecha Fin" value="<?= date('d-m-Y');?>">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui calendar end-time">
                <div class="ui input left icon">
                    <i class="hourglass full icon"></i>
                    <input id="sevent_end_time" name="sevent_end_time" type="text" placeholder="Hora Inicio" value="23:59">
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
            <select class="ui search dropdown" id="sevent-operators" name="sevent-operators">
                <option value="">- Personal -</option>
                <?php 
                foreach($operators as $op):
                ?>
                <option value="<?= $op['code'];?>"><?= $op['alias'];?></option>
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
