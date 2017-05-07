<?php
header('Content-Type: application/json; charset=utf-8');

require_once('../securimage/securimage.php');
require_once(dirname(__FILE__).'/NetToolsUtil.class.php');

session_start();

$captcha_auth = $_SESSION['captcha_auth'];
$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);

$securimage = new Securimage();
if ($captcha_auth || $securimage->check($_POST['captcha_code'])) {
    $_SESSION['captcha_auth'] = true;
    $ntu = new NetToolsUtil();
    $array = $ntu->execute($command, $hostname);
    $array['captcha_auth'] = true;
    echo json_encode($array);
} else {
    $_SESSION['captcha_auth'] = false;
    $captcha_fail = array('command'=>'', 'result'=>'CAPTCHA auth failed.', 'captcha_auth'=>false);
    echo json_encode($captcha_fail);
}
?>
