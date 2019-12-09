<?php
    namespace Src\db; 
    interface IConnection {
        function connect($host, $port, $db, $user, $password);
    }
?>