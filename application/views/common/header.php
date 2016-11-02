
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
</head>
<?php
if (ENVIRONMENT === 'development') {
  $browserSync = rtrim(base_url(), '/') . ':3060/';
  $fileHeaders = @get_headers($browserSync);

  if ($fileHeaders) { ?>
    <script id="__bs_script__">
      document.write("<script async src='http://HOST:3060/browser-sync/browser-sync-client.js?v=2.17.5'><\/script>".replace("HOST", location.hostname));
    </script>
  <?php }
} ?>
<body>