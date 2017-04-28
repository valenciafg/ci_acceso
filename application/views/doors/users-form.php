<!-- User select column -->
<div class="three wide column">
    <h5 class="ui header">Usuarios</h5>
    <div class="ui vertical menu vertical-select user-select-search">
        <?php
        foreach ($users as $user):
            ?>
            <div class="link item user-item" data-id="<?= $user['c_id'];?>" data-guid="<?= $user['b_guid'];?>"><?= $user['c_fname'].' '.$user['c_lname'];?></div>
        <?php endforeach;?>
    </div>
</div>
<!-- Access select column -->
<div class="three wide column access-column" style="display:none;">
    <h5 class="ui header">Accesos</h5>
    <div class="ui vertical menu vertical-select access-select-search">
    </div>
</div>