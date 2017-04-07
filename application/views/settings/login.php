
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Control de Acceso - Plaza Merú</title>

  <link rel="stylesheet" type="text/css" href="dist/styles/main.css">
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
</head>
<body>
	<div class="ui middle aligned center aligned grid">
	  	<div class="column">
		    <h2 class="ui primary image header">
		      <img src="assets/images/hotel_logof.png" class="image" style="width: 4.5em;">
		      <div class="content">Sistema de Control de Accesos</div>
		    </h2>
		    <form id="login-form" class="ui large form">
		      	<div class="ui stacked segment">
		        	<div class="field">
		          		<div class="ui left icon input">
		            		<i class="user icon"></i>
		            		<input type="text" name="username" placeholder="Account">
		          		</div>
		        	</div>
		        	<div class="field">
		          		<div class="ui left icon input">
		            		<i class="lock icon"></i>
		           	 		<input type="password" name="password" placeholder="Password">
		          		</div>
		        	</div>
		        	<div id="login-button" class="ui fluid large primary submit button">Login</div>
		      	</div>
		      	<div class="ui error message login-message"></div>    
		    </form>
	  	</div>
	</div>
	<script src="dist/scripts/jquery.js" type="text/javascript"></script>
	<script src="dist/scripts/libs.js" type="text/javascript"></script>
	<script src="dist/scripts/main.js" type="text/javascript"></script>
	<script src="dist/scripts/events.js"></script>
</body>
</html>