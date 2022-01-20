<?php
require_once('models/product.php');

class Dbconfig {

    public $connection;

    public function __construct() {
        $this->db_connect();
    }
        
    private function db_connect() {
        $this->connection = mysqli_connect('', '', '', '');
        if(mysqli_connect_error()) {
            die("Connection failed!");
        }
    }

    public function check($a) {
        $return = mysqli_real_escape_string($this->connection, $a);
        return $return;
    }
}
