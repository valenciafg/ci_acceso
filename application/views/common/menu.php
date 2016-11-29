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
            <a class="<?= ($item=='users'?'active ':'')?>item" href="<?= base_url().'users';?>">Usuarios</a>
            <a class="<?= ($item=='doors'?'active ':'')?>item" href="<?= base_url().'doors';?>">Puertas</a>
            <a class="<?= ($item=='schedule'?'active ':'')?>item" href="<?= base_url().'schedule';?>">Horarios</a>
        </div>
    </div>
    <a class="<?= ($item=='calendar'?'active ':'')?>item" href="<?=base_url().'calendar';?>">Calendario</a>
    <div class="right menu">
        <a href="<?= base_url().'settings';?>" class="<?= ($item=='settings'?'active ':'')?>item">Configuración</a>
        <div class="ui dropdown item item-user">
            Usuario <i class="dropdown icon"></i>
            <div class="menu">
            <a class="item">Salir</a>
            </div>
      </div>
    </div>
  </div>    
</div>
