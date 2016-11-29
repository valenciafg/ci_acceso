<div class="pusher">
<?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'home']);
?>

    <div class="ui vertical segment container first-segment">
        <h1 class="ui header">Sistema de Control de Acceso</h1>
        <?php $this->load->view('dashboard/lastDoorMovementsTable',['door_actions'=>$door_actions]);?>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js" type="text/javascript"></script>
<script src="dist/scripts/libs.js" type="text/javascript"></script>
<script src="dist/scripts/plugins.js" type="text/javascript"></script>
<script src="dist/scripts/main.js" type="text/javascript"></script>
</body>
</html>