<div class="pusher">
<?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'home']);
?>

    <div class="ui vertical segment container first-segment">
        <h1 class="ui header">Sistema de Control de Acceso</h1>
        <?php $this->load->view('dashboard/lastDoorMovementsTable',['door_actions'=>$door_actions]);?>
    </div>
    <div class="ui vertical segment">
        <h1 class="ui header">Sistema de Control de Acceso</h1>
        <div class="ui grid">
            <div class="three wide column">
                <div class="ui vertical menu vertical-select">
                    <?php
                    for($i=0;$i<50;$i++):
                        ?>
                        <a class="item">
                            Pedro Perez Delgado <?= $i;?>
                        </a>
                    <?php endfor;?>
                </div>
            </div>
            <div class="three wide column">
                <div class="ui vertical menu vertical-select">
                    <?php
                    for($i=0;$i<50;$i++):
                        ?>
                        <a class="item">
                            Pedro Perez Delgado <?= $i;?>
                        </a>
                    <?php endfor;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js"></script>
<script src="dist/scripts/main.js"></script>
<script src="dist/scripts/plugins.js"></script>
<script src="dist/scripts/config.js"></script>
</body>
</html>