
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'roomstatus']);
    $this->load->view('rooms/add-check-room');
    // var_dump($rooms);
    ?>
    <div class="ui vertical segment first-segment">
        <?php $this->load->view('rooms/room-status-list',['rooms'=>$rooms]);?>
    </div>
    <div id="room-level-list" class="overlay fixed" style="position: fixed;top: 65px;right: 5px;z-index: 99;">
        <div class="ui labeled icon vertical menu">
            <a class="item room-level-list-item">1</a>
            <a class="item room-level-list-item">2</a>
            <a class="item room-level-list-item">3</a>
            <a class="item room-level-list-item">4</a>
            <a class="item room-level-list-item">5</a>
            <a class="item room-level-list-item">6</a>
            <a class="item room-level-list-item">7</a>
            <a class="item room-level-list-item">8</a>
            <a class="item room-level-list-item">9</a>
            <a class="item room-level-list-item">10</a>
            <a class="item room-level-list-item">11</a>
            <a class="item room-level-list-item">12</a>
            <a class="item room-level-list-item">13</a>
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