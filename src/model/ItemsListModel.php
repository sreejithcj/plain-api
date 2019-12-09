<?php

    namespace Src\model;

    /*
    Model class to process the database queries. I have used plain SQL queries for this demo. In real projects, we use
    ORMs like Eloquent.
    */
    class ItemsListModel extends ModelBase {

        public function __construct() {
            parent::__construct();
        }

        public function getAllItems() {
            return $this->executeQuery("SELECT * FROM list_items");          
        }

        public function getCurrentItem() {
            return $this->executeQuery("SELECT id, item FROM list_items where id=(select currentId from list_items_current)");    
        }

        public function insertAnItem($item) { 
            $id = $this->executeStatement("INSERT INTO list_items (item) VALUES ('" . $item . "')");
            if($id) {
                return $this->executeStatement("UPDATE list_items_current set currentId=". $id);   
            } else {
                return null;
            }           
        }

        public function updateAnItem($id) {
            return $this->executeStatement("UPDATE list_items_current SET currentId =" .$id);   
        }
    }
?>