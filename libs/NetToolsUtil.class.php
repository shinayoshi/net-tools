<?php
class NetToolsUtil {
    public function __construct() {
    }
    public function execute($command, $hostname) {
        $result = null; 
        switch ($command) {
            case 'ping':
                $result = $this->executePing($hostname);
                break;
            case 'traceroute':
                $result = $this->executeTraceroute($hostname);
                break;
            case 'dig':
                $result = $this->executeDig($hostname);
                break;
            default:
                $result = array('command'=>'', 'result'=>'Unknown command: ' . $command);
        }
        return $result;
    }
    private function executePing($hostname) {
        $array = array('command'=>'', 'result'=>'');
        if ($this->isIPAddress($hostname) || $this->isHostname($hostname)) {
            $cmd = 'ping -c 4 ' . $hostname;
            $array['command'] = $cmd;
            $array['result'] = shell_exec($cmd);
        } else {
            $array['result'] = $hostname . ' is not FQDN/IP Address.';
        }
        return $array;
    }
    private function executeTraceroute($hostname) {
        $array = array('command'=>'', 'result'=>'');
        if ($this->isIPAddress($hostname) || $this->isHostname($hostname)) {
            $cmd = 'traceroute ' . $hostname;
            $array['command'] = $cmd;
            $array['result'] = shell_exec($cmd);
        } else {
            $array['result'] = $hostname . ' is not FQDN/IP Address.';
        }
        return $array;
    }
    private function executeDig($hostname) {
        $array = array('command'=>'', 'result'=>'');
        if ($this->isIPAddress($hostname)) {
            $cmd = 'dig -x ' . $hostname;
            $array['command'] = $cmd;
            $array['result'] = shell_exec($cmd);
        } else if ($this->isHostname($hostname)) {
            $cmd = 'dig ' . $hostname;
            $array['command'] = $cmd;
            $array['result'] = shell_exec($cmd);
        } else {
            $array['result'] = $hostname . ' is not FQDN/IP Address.';
        }
        return $array;
    }
    private function isIPAddress($ipaddr) {
        return filter_var($ipaddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
    private function isHostname($hostname) {
        return $this->isIPAddress(gethostbyname($hostname));
    }
}
?>
