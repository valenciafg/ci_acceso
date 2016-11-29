<h2 class="ui header">
    Últimos movimientos de Puertas
    <div class="sub header">Resumen de actividades de acceso a puertas.</div>
</h2>
<table id="lastDoorMov" class="ui celled table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Puerta</th>
            <th>Usuario</th>
            <th>Evento</th>
            <th>Fecha y Hora</th>
        </tr>
    </thead>
    <tbody id="lastDoorMov-body">
    <?php
        foreach ($door_actions as $action):
            $user = (isset($action['x_fname'])&&!empty($action['x_fname'])?$action['x_fname']:'').' '.(isset($action['x_lname'])&&!empty($action['x_lname'])?$action['x_lname']:'');
            $movement_date = date("d/m/Y H:i:s", strtotime($action['x_timestamp']));;
            $event = $action['x_hist_type'];
            if($event===35){
                $event = "<div class='ui red label'>Acceso Denegado</div>";
            }else{
                $event = "<div class='ui green label'>Puerta Abierta</div>";
            }
    ?>
        <tr>
            <td><?=$action['x_term_name'];?></td>
            <td><?=$user;?></td>
            <td><?=$event;?></td>
            <td><?=$movement_date;?></td>
        </tr>
    <?php
        endforeach;
    ?>
    </tbody>
</table>