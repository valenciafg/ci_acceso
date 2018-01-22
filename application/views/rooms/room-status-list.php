<h2 class="ui header">
    Estatus de Habitaciones
</h2>
<?php 
if(!empty($rooms)):?>
<div class="ui cards">
<?php 
foreach($rooms as $r):?>
<div class="card">
    <div class="content">
        <i class="ui right floated fa fa-bed fa-2x fa-border" aria-hidden="true"></i>
        <div class="header">
            <?= $r['roomName'];?>
        </div>
        <div class="meta">
            <?= $r['Location'].'. Ext.: '.$r['PhoneNumber'];?>
        </div>
        <div class="description">
            <?= $r['eventDescription']?>
        </div>
    </div>
</div>
<?php
endforeach;?>
</div>
<?php 
endif;?>

