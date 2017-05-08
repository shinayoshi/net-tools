<?php
header('Content-Type: application/json; charset=utf-8');

require_once(dirname(__FILE__).'/NetToolsUtil.class.php');

session_start();

$captcha_auth = $_SESSION['captcha_auth'];
$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);

if ($captcha_auth) {
    $ntu = new NetToolsUtil();
    $result = $ntu->execute($command, $hostname);
    echo json_encode($result);
} else {
    $result = array('command'=>'', 'result'=>'CAPTCHA authentication is not done.');
    echo json_encode($result);
}
?>
