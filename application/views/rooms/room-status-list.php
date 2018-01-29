<h2 class="ui header">
    Estatus de Habitaciones
</h2>
<?php 
if(!empty($rooms)){
// var_dump($rooms);
    $group = true;
    $piso = '';
    for($i = 0; $i < count($rooms); $i++){
        $availabilityClass = 'negro';
        if($rooms[$i]['availabilityCode'] !== null){
            $availabilityCode = $rooms[$i]['availabilityCode'];
            switch($availabilityCode){
                case 1:
                    $availabilityClass = 'negro';
                    break;
                case 2:
                    $availabilityClass = 'verde';
                    break;
                case 3:
                    $availabilityClass = 'rojo';
                    break;
                case 4:
                    $availabilityClass = 'naranja';
                    break;
                case 5:
                    $availabilityClass = 'amarillo';
                default:
                    $availabilityClass = 'negro';
                    break;
            }
        }
        $statusClass = 'negro';
        if($rooms[$i]['statusCode'] !== null){
            $statusCode = $rooms[$i]['statusCode'];
            switch($statusCode){
                case 1:
                    $statusClass = 'verde';
                    break;
                case 2:
                    $statusClass = 'amarillo';
                    break;
                case 3:
                    $statusClass = 'azul';
                    break;
                case 4:
                    $statusClass = 'rojo';
                    break;
                case 5:
                    $statusClass = 'negro';
                    break;
                case 6:
                    $statusClass = 'naranja';
                    break;
                case 7:
                    $statusClass = 'morado';
                    break;
                default:
                    $statusClass = 'negro';
                    break;
            }
        }
        $iconClass = 'fa-bed';
        if($rooms[$i]['PhoneNumber']== '304'){
            $iconClass = 'fa-wheelchair-alt';
        }        
        if($rooms[$i+1]['Location'] !== $piso){
            echo "<div class=\"ui cards\">";
        }?>
        <div class="card">
            <div class="content">
                <i class="ui left floated fa <?= $iconClass;?> fa-2x fa-border <?= $availabilityClass;?>" aria-hidden="true"></i>
                <div class="header borde-negro <?= $statusClass;?>">
                    <?= $rooms[$i]['roomName'];?>
                </div>
                <div class="meta">
                    <?= $rooms[$i]['Location'].'. Ext.: '.$rooms[$i]['PhoneNumber'];?>
                    
                </div>
                <div class="meta">
                    <?php if($rooms[$i]['statusCode'] !== null):?>
                    <?= '<br/>'.$rooms[$i]['statusName'];?>
                    <?php endif;?>
                </div>
                <div class="description">
                    <?= $rooms[$i]['eventDescription']?>
                    <?php if($rooms[$i]['availabilityCode'] !== null):?>
                    <?= '<br/><br/><div style="text-align:center;">'.$rooms[$i]['availabilityName'].'</div>';?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php
        if($rooms[$i+1]['Location'] !== $piso){
            echo"</div>";
        }
        $piso = $rooms[$i]['Location'];
    }?>
<?php 
}
?>