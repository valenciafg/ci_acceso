<div class="ui fixed stackable menu">
    <div class="item">
        <img src="dist/images/hotel_logof.png">
    </div>
    <a class="<?= ($item=='home'?'active ':'')?>item" href="<?=base_url();?>">
        Home
    </a>
    <div class="ui item dropdown item-doors">
        Accesos <i class="dropdown icon"></i>
        <div class="menu">
            <a class="<?= ($item=='main'?'active ':'')?>item" href="<?= base_url().'main';?>">Ult. Accesos</a>
            <a class="<?= ($item=='users'?'active ':'')?>item" href="<?= base_url().'users';?>">Usuarios</a>
            <a class="<?= ($item=='doors'?'active ':'')?>item" href="<?= base_url().'doors';?>">Puertas</a>
            <a class="<?= ($item=='schedule'?'active ':'')?>item" href="<?= base_url().'schedule';?>">Horarios</a>
            <a class="<?= ($item=='permission'?'active ':'')?>item" href="<?= base_url().'permission';?>">Permisos</a>
        </div>
    </div>
    <div class="ui item dropdown item-doors">
        Captahuella <i class="dropdown icon"></i>
        <div class="menu">
            <a class="<?= ($item=='fpusers'?'active ':'')?>item" href="<?= base_url().'fpusers';?>">Usuarios</a>
            <a class="<?= ($item=='sfootprint'?'active ':'')?>item" href="<?= base_url().'sfootprint';?>">Busquedas</a>
        </div>
    </div>
    <div class="ui item dropdown item-doors">
        Habitaciones <i class="dropdown icon"></i>
        <div class="menu">
            <a class="<?= ($item=='roomstatus'?'active ':'')?>item" href="<?= base_url().'roomstatus';?>">Room Status</a>
            <a class="<?= ($item=='roomevents'?'active ':'')?>item" href="<?= base_url().'roomevents';?>">Eventos</a>
            <a class="<?= ($item=='roperators'?'active ':'')?>item" href="<?= base_url().'roperators';?>">Config. Personal</a>
            <a class="<?= ($item=='roomeventtypes'?'active ':'')?>item" href="<?= base_url().'roomeventtypes';?>">Config. Tipos de Eventos</a>            
        </div>
    </div>
    <div class="right menu">
        <a href="<?= base_url().'settings';?>" class="<?= ($item=='settings'?'active ':'')?>item">Configuración</a>
        <div class="ui dropdown item item-user">
            Usuario <i class="dropdown icon"></i>
            <div class="menu">
            <a class="item" href="<?= base_url()."logout";?>">Salir</a>
            </div>
      </div>
    </div>
  </div>    
</div>
