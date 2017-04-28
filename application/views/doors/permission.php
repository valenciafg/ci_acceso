<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'permission']);
    ?>

    <div class="ui vertical segment first-segment">
        <h3>Consulta de usuarios con acceso a Puertas</h3>
        <div class="ui grid">
            <?php $this->load->view('doors/permission-form',['doors'=>$doors]);?>
            <!-- Door permission results -->
            <div class="ten wide column">
                <div id="door-result-message"></div><br/>
                <div id="door-result-loading" style="display: none;">
                    <div class="ui active inverted dimmer">
                        <div class="ui text loader">Cargando</div>
                    </div>
                    <p></p>
                </div>
                <div id="door-result-list" style="display: none;">
                    <?php $this->load->view('doors/permission-result-list');?>
                </div>
            </div>
        </div>
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