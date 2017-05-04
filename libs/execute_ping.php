<?php
header('Content-Type: text/plain');

require(dirname(__FILE__).'/NetToolsUtil.class.php');

$hostname = htmlspecialchars($_POST['hostname']);
$result = "";

$ntu = new NetToolsUtil();
if ($ntu->isIPAddress($hostname) || $ntu->isHostname($hostname)) {
    $cmd = 'ping -c 4 ' . $hostname;
    $result = shell_exec($cmd);
} else {
    $result = $hostname . ' is not FQDN/IP Address';
}

echo $result;
?>
