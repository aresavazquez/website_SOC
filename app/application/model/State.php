<?php
class State {
    private static $instance = false;
    private static $PDO;

    protected function __construct() {
        self::$PDO = new PDODB('states');
    }
    /**
    * Singleton pattern
    */
    public static function getInstance() {
        if( !self::$instance ) self::$instance = new self();
        return self::$instance;
    }

    public static function all() {
        $result = self::$PDO->_all('*');
        return $result->get('name');
    }
}
