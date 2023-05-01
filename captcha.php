<?php
header('Content-Type: application/json; charset=utf-8');

require_once('./vendor/autoload.php');

session_start();

if (isset($_SESSION['captcha_auth'])) {
    $captcha_auth = $_SESSION['captcha_auth'];
} else {
    $captcha_auth = false;
}


$securimage = new Securimage();
if ($captcha_auth || $securimage->check($_POST['captcha_code'])) {
    $_SESSION['captcha_auth'] = true;
    $_SESSION['auth_time'] = strtotime('now');
    $captcha_result = array('captcha_auth'=>true);
    echo json_encode($captcha_result);
} else {
    $_SESSION['captcha_auth'] = false;
    $captcha_result = array('captcha_auth'=>false);
    echo json_encode($captcha_result);
}
?>
