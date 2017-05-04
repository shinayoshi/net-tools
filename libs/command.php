<?php
header('Content-Type: text/plain');

require(dirname(__FILE__).'/NetToolsUtil.class.php');

$command = htmlspecialchars($_POST['command']);
$hostname = htmlspecialchars($_POST['hostname']);
$array = array('command'=>'', 'result'=>'');

$ntu = new NetToolsUtil();
if ($command === 'ping') {
    if ($ntu->isIPAddress($hostname) || $ntu->isHostname($hostname)) {
        $cmd = 'ping -c 4 ' . $hostname;
        $array['command'] = $cmd;
        $array['result'] = shell_exec($cmd);
    } else {
        $array['result'] = $hostname . ' is not FQDN/IP Address';
    }
} else if ($command === 'traceroute') {
    if ($ntu->isIPAddress($hostname) || $ntu->isHostname($hostname)) {
        $cmd = 'traceroute ' . $hostname;
        $array['command'] = $cmd;
        $array['result'] = shell_exec($cmd);
    } else {
        $array['result'] = $hostname . ' is not FQDN/IP Address';
    }
} else {
        $array['result'] = 'Unknown command: ' . $command;
}

echo json_encode($array);
?>
