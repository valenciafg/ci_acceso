<h2 class="ui header">
    Usuarios de Captahuellas
    <div class="sub header">Usuarios registrados en captahuella de control.</div>
</h2>
<table id="footprintUsersTable" class="ui celled table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Usuario Profit</th>
            <th>Estatus</th>
            <th>Tipo</th>
            <th>Ausencia</th>
            <th>Nota Ausencia</th>
            <th>Departamento</th>
            <th>Fecha de Creacion</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody id="footprintUsersTable-body">
    <?php
        foreach ($users as $user):
            $user_name = $user['FIRST_NAME'].' '.$user['LAST_NAME'];
            $create_date = date("d/m/Y h:i:s A", strtotime($user['CREATE_DATE']));;
            $estatus = $user['STATUS'];
            if($estatus==='Inactive' || $estatus==='Terminate'){
                $estatus = "<div class='ui red label'>Inactivo</div>";
            }else{
                $estatus = "<div class='ui green label'>Activo</div>";
            }
            switch ($user['TYPE_NAME']) {
                case 'Regular':
                    $tipo_empleado = 'Regular';
                    break;
                case 'Temporary':
                    $tipo_empleado = 'Temporal';
                    break;
                case 'Seasonal':
                    $tipo_empleado = 'Temporada';
                    break;
                case 'Contracted':
                    $tipo_empleado = 'Contratado';
                    break;
                case 'Part Time':
                    $tipo_empleado = 'Tiempo Parcial';
                    break;
                default:
                    $tipo_empleado = 'No definido';
                    break;
            }
            if($user['PHOTO'] !== null){
                $b64Src = "data:image/jpeg;base64," . base64_encode($user['PHOTO']);
                $foto = '<img src="'.$b64Src.'" alt="" style="max-height:150px;max-width:150px"/>';
            }else{
                $foto = '';
            }
    ?>
        <tr>
            <td><?=$user['USER_ID'];?></td>
            <td><?=$user['FIRST_NAME'];?></td>
            <td><?=$user['LAST_NAME'];?></td>
            <td><?=$user['PROFIT_USER'];?></td>
            <td><?=$estatus;?></td>
            <td><?= $tipo_empleado;?></td>
            <td><?=$user['ABSENCE_TYPE'];?></td>
            <td><?=$user['ABSENCE_NOTES'];?></td>
            <td><?=$user['DEPARTMENT_NAME'];?></td>
            <td data-order="<?=strtotime($user['CREATE_DATE']);?>"><?=$create_date;?></td>
            <td><?= $foto;?></td>
        </tr>
    <?php
        endforeach;
    ?>
    </tbody>
</table>