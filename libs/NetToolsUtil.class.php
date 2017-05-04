<?php
class NetToolsUtil {
    public function __construct() {
    }
    public function isIPAddress($ipaddr) {
        return filter_var($ipaddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
    public function isHostname($hostname) {
        // ToDo check hostname
        return false;
    }
}
?>
