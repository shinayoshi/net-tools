<?php
require_once(dirname(__FILE__).'/../vendor/autoload.php');

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

date_default_timezone_set("Asia/Tokyo");

class NetToolsLogger {
    private static $instance = null;
    private $log = null;
    private function __construct() {
        $this->log = new Logger('net-tools');
        $this->log_formatter = new LineFormatter("[%datetime%] %level_name%: %message% %context% %extra%\n");
        $this->log_handler = new RotatingFileHandler(dirname(__FILE__).'/../logs/net-tools.log', 0, Level::Info, true, 0644);
        $this->log_handler->setFormatter($this->log_formatter);
        $this->log->pushHandler($this->log_handler);
    }
    final public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
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

