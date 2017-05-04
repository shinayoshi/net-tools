<?php
header('Content-Type: text/plain');

require(dirname(__FILE__).'/NetToolsUtil.class.php');

$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);
$result = "";

$ntu = new NetToolsUtil();
if ($command === 'ping') {
    if ($ntu->isIPAddress($hostname) || $ntu->isHostname($hostname)) {
        $cmd = 'ping -c 4 ' . $hostname;
        $result = shell_exec($cmd);
    } else {
        $result = $hostname . ' is not FQDN/IP Address';
    }
} else if ($command === 'traceroute') {
    if ($ntu->isIPAddress($hostname) || $ntu->isHostname($hostname)) {
        $cmd = 'traceroute ' . $hostname;
        $result = shell_exec($cmd);
    } else {
        $result = $hostname . ' is not FQDN/IP Address';
    }
} else {
        $result = 'Unknown command: ' . $command;
}

echo $result;
?>
