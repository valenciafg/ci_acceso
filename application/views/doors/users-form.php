<h3>Consulta de acceso por Usuarios</h3>
<form id="users-form" class="ui form">
    <div class="fields">
        <div class="five wide field">
            <select id="user-search" class="ui fluid search dropdown">
                <option>Seleccione un usuario</option>
                <?php
                foreach ($users as $user):
                ?>
                <option value="<?= $user['c_id'];?>" data-guid="<?= $user['b_guid'];?>"><?= $user['c_fname'].' '.$user['c_lname'];?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div id="access-content" class="five wide field">
            <select id="user-access" class="ui disabled dropdown">
                <option>Accesos</option>
            </select>
        </div>
        <div class="two wide field">
            <div id="search-users" class="ui vertical blue animated button" tabindex="0">
                <div class="hidden content">Buscar</div>
                <div class="visible content">
                    <i class="search icon"></i>
                </div>
            </div>
        </div>
    </div>
</form>
