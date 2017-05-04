<?php
header('Content-Type: application/json; charset=utf-8');

require(dirname(__FILE__).'/NetToolsUtil.class.php');

$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);

$ntu = new NetToolsUtil();

echo json_encode($ntu->execute($command, $hostname));
?>
