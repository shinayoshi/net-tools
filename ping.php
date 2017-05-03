<?php
$cmd="/sbin/ping -c 4 localhost";
$res=shell_exec($cmd);
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title>ping - net-tools</title>
    <meta name="description" content="shinayoshi shinayoshi.net" />
    <meta name="author" content="shinayoshi" />
  </head>
  <body>
    <p><?php var_dump($res); ?></p>
  </body>
</html>
