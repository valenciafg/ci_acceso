<div class="pusher">
<?php
    $this->load->view('common/header');
    $this->load->view('common/menu');
?>

    <div class="ui vertical segment container first-segment">
        <h1 class="ui header">Sistema de Control de Acceso</h1>
        <?php $this->load->view('dashboard/lastDoorMovementsTable',['door_actions'=>$door_actions]);?>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js"></script>
<script src="dist/scripts/main.js"></script>
<script src="dist/scripts/plugins.js"></script>
<script src="dist/scripts/config.js"></script>
</body>
</html>