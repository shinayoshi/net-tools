<?php
header('Content-Type: application/json; charset=utf-8');

require_once(dirname(__FILE__).'/libs/NetToolsUtil.class.php');
require_once(dirname(__FILE__).'/libs/NetToolsLogger.class.php');

session_start();

$ini_file = './configs/net-tools.ini';
$captcha_auth = $_SESSION['captcha_auth'];
$nowtime = strtotime('now');
$last_exec_time = $_SESSION['last_exec_time'];
$client = $_SERVER['REMOTE_ADDR'];
$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);

$logger = NetToolsLogger::getInstance();
$logger->info('srcip: '.$client.', command: '.$command.', hostname: '.$hostname);

if ($captcha_auth) {
    if (!isset($last_exec_time) || $nowtime - $last_exec_time >= 1) {
        $_SESSION['last_exec_time'] = $nowtime;
        $ntu = new NetToolsUtil($ini_file);
        $result = $ntu->execute($command, $hostname);
        echo json_encode($result);
    } else {
        $result = array('command'=>'', 'result'=>'Command exec interval is too short.');
        echo json_encode($result);
    }
} else {
    $result = array('command'=>'', 'result'=>'CAPTCHA authentication is not done.');
    echo json_encode($result);
}
?>
