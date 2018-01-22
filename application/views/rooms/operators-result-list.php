<h2 class="ui header">
    Personal de Habitaciones
</h2>
<table id="operatorsTable" class="ui celled table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Codigo</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="operatorsTable-body">
    <?php
        foreach ($operators as $op):
            $estatus = $op['status'];
            if($estatus===1){
                $estatus = "<div class='ui green label'>Activo</div>";                
            }else{
                $estatus = "<div class='ui red label'>Inactivo</div>";
            }
            $btn = "<button data-id=\"".$op['id']."\" class=\"tiny ui orange button edit-operator-btn\">Editar</button>";
    ?>
        <tr>
            <td><?=$op['id'];?></td>
            <td><?=$op['code'];?></td>
            <td><?= $op['alias'];?></td>
            <td><?= $op['name'];?></td>
            <td><?=$op['DEPARTMENT_NAME'];?></td>
            <td><?=$estatus;?></td>
            <td><?= $btn;?></td>
        </tr>
    <?php
        endforeach;
    ?>
    </tbody>
</table>