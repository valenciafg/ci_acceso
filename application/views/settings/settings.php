<div class="pusher">
    <?php
    $this->load->view('common/header');
	$this->load->view('common/menu',['item'=>'settings']);
	// var_dump($settings);
    ?>
    <div class="ui vertical segment container first-segment">
		<div id="setting-error-msg"></div>
		<div id="setting-positive-msg"></div>
    	<div class="ui top attached tabular menu settings">
    		<div class="item active" data-tab="tab-general">General</div>
    	</div>
    	<?php $this->load->view('settings/general_tab');?>
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