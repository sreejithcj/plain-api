<?php

namespace Src\router;
use Src\config\config;
use Src\controller\ItemsListController;
use Src\controller\RESTBase;

//Custom REST API router to route the calls to individual controllers
class Api extends RESTBase{
    
    private $listControllers = array();

    public function __construct() {
        parent::__construct();
        $this->initializeControllers();
    }

    //If the request is good and if the token is good, invoke the handler function
    public function process() {
        if($this->handleBadRequests() && $this->handleAuthentication()) {
            $controllerObj = $this->listControllers[$this->path]['controller'];
            $function = $this->listControllers[$this->path]['functions'][$this->request]; 

            $controllerObj->handle($function); 
        }  
    }

    //Respond with 404 for bad requests
    private function handleBadRequests() {
        //Return 404 if the requested path is not found
        if(!array_key_exists($this->path,$this->listControllers)) {
            $this->sendResponse(404,'Not Found');
            exit();
        }
        //Return 404 if the request method is not found
        if(!array_key_exists($this->request,$this->listControllers[$this->path]['functions'])) {
            $this->sendResponse(404,'Not Found');
            exit();
        }
        return true;        
    }

    //Return with 401 if the Token is not the right one
    private function handleAuthentication() { 
        if($this->getTheToken() != config::$configParams['staticToken']) {
            $this->sendResponse(401,'Unauthorized Request');
            exit();
        }
        return true;
    }

    /* A structure to map the API request paths to the endpoints in individual controllers */
    private function initializeControllers() {
        $this->listControllers = array(
            'items' => array('controller'=>new ItemsListController(), 'functions' => array('GET'=> 'getAllItems','PUT'=>'updateAnItem','POST'=>'insertAnItem')),
            'items/current' => array('controller'=>new ItemsListController(), 'functions' => array('GET'=> 'getCurrentItem'))
        );
    }
}
?>