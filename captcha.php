<?php
header('Content-Type: application/json; charset=utf-8');

require_once('./securimage/securimage.php');

session_start();

$captcha_auth = $_SESSION['captcha_auth'];

$securimage = new Securimage();
if ($captcha_auth || $securimage->check($_POST['captcha_code'])) {
    $_SESSION['captcha_auth'] = true;
    $captcha_result = array('captcha_auth'=>true);
    echo json_encode($captcha_result);
} else {
    $_SESSION['captcha_auth'] = false;
    $captcha_result = array('captcha_auth'=>false);
    echo json_encode($captcha_result);
}
?>
