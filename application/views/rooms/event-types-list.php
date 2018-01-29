<h2 class="ui header">
    Tipos de Eventos
    <button class="tiny ui green button add-event-type-btn">Agregar</button>
</h2>
<table id="eventTypesTable" class="ui celled table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Clasificacion</th>
            <th>Departamento</th>
            <th>Disponibilidad</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="eventTypesTable-body">
    <?php
        foreach ($eventtypes as $et):
            $btn = "<button data-id=\"".$et['id']."\" data-dp=\"".$et['department']."\" class=\"tiny ui orange button edit-event-type-btn\">Editar</button>";
    ?>
        <tr>
            <td><?= $et['id'];?></td>
            <td><?= $et['eventCode'];?></td>
            <td><?= $et['description'];?></td>
            <td><?= $et['className'];?></td>
            <td><?= $et['DEPARTMENT_NAME'];?></td>
            <td><?= $et['availabilityName'];?></td>
            <td><?= $et['statusName'];?></td>
            <td><?= $btn;?></td>
        </tr>
    <?php
        endforeach;
    ?>
    </tbody>
</table>