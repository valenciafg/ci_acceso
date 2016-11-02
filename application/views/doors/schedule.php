<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu');
    ?>

    <div class="ui vertical segment container first-segment">
        <?php $this->load->view('doors/schedule-form');?>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js"></script>
<script src="dist/scripts/main.js"></script>
<script src="dist/scripts/plugins.js"></script>
<script src="dist/scripts/config.js"></script>
<script src="dist/scripts/events.js"></script>
</body>
</html>