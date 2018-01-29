<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'roomeventtypes']);
    // var_dump($availability);
    // var_dump($status);
    ?>
    <div class="ui vertical segment container first-segment">
        <?php $this->load->view('rooms/event-types-add-modal');?>
        <?php $this->load->view('rooms/event-types-edit-modal');?>
        <?php $this->load->view('rooms/event-types-list',['eventtypes'=>$eventtypes,'availability'=>$availability,'status'=>$status]);?>
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