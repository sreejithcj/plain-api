<?php
namespace Src\db;

class DBConnection {

    private $host = null;
    private $port = null;
    private $db = null;
    private $user = null;
    private $pass = null;

    //Retrieved from .env file
    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
        $this->db   = getenv('DB_DATABASE');
        $this->user = getenv('DB_USERNAME');
        $this->pass = getenv('DB_PASSWORD');
    }

    //Use mysqli for DB access. MySQLi is used for database access
    public function connection($connector) {
        return $connector->connect($this->host,$this->port,$this->db,$this->user,$this->pass);
    }
}