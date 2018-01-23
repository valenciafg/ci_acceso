<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'roomevents']);
    ?>

    <div class="ui vertical segment container first-segment">
        <?php $this->load->view('rooms/room-event-form',['rooms'=>$rooms,'operators'=>$operators]);?>
    </div>
    <div class="ui basic vertical segment container">
        <div id="room-event-message" style="display: none;">
        </div>
    </div>
    <div id="room-event-loading" class="ui basic vertical segment container" style="display: none;">
        <div class="ui active inverted dimmer">
            <div class="ui text loader">Cargando</div>
        </div>
        <p></p>
    </div>
    <div id="room-event-list" class="ui basic vertical segment" style="display: none;">
        <?php $this->load->view('rooms/room-event-list');?>
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