<div class="three wide column">
    <h5 class="ui header">Puertas</h5>
    <div class="ui vertical menu vertical-select door-permission-select-search">
    <?php
    foreach ($doors as $door):
        ?>
        <div class="link item door-item" data-id="<?= $door['tp_term_id'];?>" data-guid="<?= $door['tp_guid'];?>"><?= $door['tp_term_name'];?></div>
    <?php endforeach;?>
    </div>
</div>