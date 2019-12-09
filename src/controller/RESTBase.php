<?php

namespace Src\controller;
use Src\config\config;

/* 
Base class with utility functions to handle API requests, responses and parameters.
*/
class RESTBase {
    
    protected $payload = array();
    protected $request = null;
    protected $URI = null;
    protected $path = null;
    protected $explodedPath = null;

    public function __construct() {
        $this->readRequest();
        $this->readPayload();
        $this->readPath();
    }

    //Reads the request method from the REST API (GET/POST/PUT etc)
    protected function readRequest() {
        $this->request = $_SERVER["REQUEST_METHOD"];
    }

    //Read the payload from the REST API request
    private function readPayload() {
        $this->payload = (array) json_decode(file_get_contents('php://input'), TRUE);
    }

    //Parse the URI and save the path
    private function readPath() {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $this->path =  $str = ltrim($url['path'], '/');
    }

    private function getStatusMessage($code) {
        $messages = array(
            200 => 'OK',
            201 => 'CREATED',
            401 => 'Unauthorized Request',
            404 => 'NOT FOUND',
            500 => 'Internal Server Error'
        );
        return ($messages[$code]) ? $messages[$code] : $messages[500];
    }

    //Read the access token from headers
    protected function getTheToken() {
        $headers = apache_request_headers();
        return $headers['Token'];
    }

    //Send the HTTP response back to the client
    protected function sendResponse($code, $data) {
        $response['status_code_header'] = 'HTTP/1.1 '. $code. $this->getStatusMessage($code);
        $response['body'] = $data;

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body']; 
        }
    }
}