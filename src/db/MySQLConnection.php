<?php 
namespace Src\db; 
class MySQLConnection implements IConnection {

    public function connect($host, $port, $db, $user, $password) {
        try {
            return mysqli_connect($host,$user,$password,$db,$port);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
?>