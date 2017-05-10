<?php
require_once(dirname(__FILE__).'/../log4php/Logger.php');
Logger::configure(dirname(__FILE__).'/../configs/logging.xml');

class NetToolsLogger {
    private static $instance = null;
    private $log = null;
    private function __construct() {
        $this->log = Logger::getLogger(__CLASS__);
    }
    final public static function getInstance() {
        if ($instance === null) {
            $instance = new self;
        }
        return $instance;
    }
    final public function __clone() {
        throw new Exception("this instance is singleton class.");
    }
    public function trace($message) {
        $this->log->trace($message);
    }
    public function debug($message) {
        $this->log->debug($message);
    }
    public function info($message) {
        $this->log->info($message);
    }
    public function warn($message) {
        $this->log->warn($message);
    }
    public function error($message) {
        $this->log->error($message);
    }
    public function fatal($message) {
        $this->log->fatal($message);
    }
}
?>

