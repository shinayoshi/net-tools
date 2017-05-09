<?php
class NetToolsUtil {
    private $ping = '';
    private $traceroute = '';
    private $dig = '';
    public function __construct($ini_file) {
        $ini = parse_ini_file($ini_file);
        if (file_exists($ini['ping'])) {
            $this->ping = $ini['ping'].' '.$ini['ping_option'];
        } else {
            $this->ping = '';
        }
        if (file_exists($ini['traceroute'])) {
            $this->traceroute = $ini['traceroute'].' '.$ini['traceroute_option'];
        } else {
            $this->ping = '';
        }
        if (file_exists($ini['dig'])) {
            $this->dig = $ini['dig'].' '.$ini['dig_option'];
        } else {
            $this->ping = '';
        }
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
        if ($this->ping === '') {
            $array['result'] = 'command not found';
            return $array;
        }

        if ($this->isIPAddress($hostname) || $this->isHostname($hostname)) {
            $cmd = $this->ping.' '.$hostname;
            $array['command'] = $this->getBasename($cmd);
            $array['result'] = shell_exec($cmd);
        } else {
            $array['result'] = $hostname . ' is not FQDN/IP Address.';
        }
        return $array;
    }
    private function executeTraceroute($hostname) {
        $array = array('command'=>'', 'result'=>'');
        if ($this->traceroute === '') {
            $array['result'] = 'command not found';
            return $array;
        }

        if ($this->isIPAddress($hostname) || $this->isHostname($hostname)) {
            $cmd = $this->traceroute.' '.$hostname;
            $array['command'] = $this->getBasename($cmd);
            $array['result'] = shell_exec($cmd);
        } else {
            $array['result'] = $hostname . ' is not FQDN/IP Address.';
        }
        return $array;
    }
    private function executeDig($hostname) {
        $array = array('command'=>'', 'result'=>'');
        if ($this->dig === '') {
            $array['result'] = 'command not found';
            return $array;
        }

        if ($this->isIPAddress($hostname)) {
            $cmd = $this->dig.' -x '.$hostname;
            $array['command'] = $this->getBasename($cmd);
            $array['result'] = shell_exec($cmd);
        } else if ($this->isHostname($hostname)) {
            $cmd = $this->dig.' '.$hostname;
            $array['command'] = $this->getBasename($cmd);
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
    private function getBasename($cmd) {
        $tmp = '';
        if (strpos($cmd, '/') !== false) {
            $tmp = substr(strrchr($cmd, "/"), 1);
        } else {
            $tmp = $cmd;
        }
        return $tmp;
    }
}
?>
