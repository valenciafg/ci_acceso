
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'roomstatus']);
    // var_dump($rooms);
    ?>
    <div class="ui vertical segment first-segment">
        <?php $this->load->view('rooms/room-status-list',['rooms'=>$rooms]);?>
    </div>
    <div id="upScrollToTop">
        <i class="fa fa-2x fa-arrow-circle-o-up" aria-hidden="true"></i>
    </div>
    <div id="upScrollToDown">
        <i class="fa fa-2x fa-arrow-circle-o-down" aria-hidden="true"></i>
    </div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js" type="text/javascript"></script>
<script src="dist/scripts/libs.js" type="text/javascript"></script>
<script src="dist/scripts/plugins.js" type="text/javascript"></script>
<script src="dist/scripts/main.js" type="text/javascript"></script>
<script src="dist/scripts/events.js"></script>
</body>
</html>