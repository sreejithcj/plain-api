<?php

namespace Src\model;
use Src\db\DBConnection;
use Src\db\MySQLConnection;

//Base class for the model class
class ModelBase {

    protected $dbObject = null;
    public function __construct () {
        $this->dbObject = (new DBConnection())->connection(new MySQLConnection());
    }

    //Generic function to execute the insert/update statements
    protected function executeStatement($statement) {
        try {     
            $result = $this->dbObject->query($statement);
            return $this->dbObject->insert_id;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    //Generic function for executing the queries
    protected function executeQuery($statement) {
        try {     
            $result = $this->dbObject->query($statement);
            if(is_object($result)) {
                return json_encode($result->fetch_all());
            } else {
                return json_encode($result);
            }
                  
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
?>