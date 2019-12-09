<?php

namespace Src\controller;
use Src\controller\BaseController;
use Src\model\ItemsListModel;

class ItemsListController extends BaseController {
    private $itemsListModel;

    public function __construct() {
        parent::__construct();
        $this->itemsListModel = new ItemsListModel();
    }

    //Main function of a controller to handle the request from NavigatorController
    public function handle($func) {
        $this->$func(); 
    }

    //Retrieve all items in the list
    private function getAllItems() {
        $this->sendResponse(200,$this->itemsListModel->getAllItems());
    }

    //Retrieve the currently selected item
    private function getCurrentItem() {
        $this->sendResponse(200,$this->itemsListModel->getCurrentItem());
    }

    //Insert a new item to the database
    private function insertAnItem() {
        $this->sendResponse(201,$this->itemsListModel->insertAnItem($this->payload['item']));  
    }

    //Updates an item to database
    private function updateAnItem() {
        $this->sendResponse(200,$this->itemsListModel->updateAnItem($this->payload['id']));
    }
}
?>