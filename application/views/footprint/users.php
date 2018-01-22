<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'fpusers']);
    ?>
    <div class="ui vertical segment container first-segment">
        <?php $this->load->view('footprint/usersTable',['users'=>$footprint_users]);?>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js" type="text/javascript"></script>
<script src="dist/scripts/libs.js" type="text/javascript"></script>
<script src="dist/scripts/plugins.js" type="text/javascript"></script>
<script src="dist/scripts/main.js" type="text/javascript"></script>
<script src="dist/scripts/events.js"></script>
</body>
</html>