<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'users']);
    ?>

    <div class="ui vertical segment first-segment">
        <h3>Consulta de acceso por Usuarios</h3>
        <div class="ui grid">
            <?php $this->load->view('doors/users-form',['users'=>$door_users]);?>
            <!-- Doors movement result list -->
            <div class="ten wide column">
                <div id="users-message"></div><br>
                <div id="users-loading" style="display: none;">
                    <div class="ui active inverted dimmer">
                        <div class="ui text loader">Cargando</div>
                    </div>
                    <p></p>
                </div>
                <div id="users-result-list" style="display: none;">
                    <?php $this->load->view('doors/user-result-list');?>
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