<?php

namespace Src\controller;
use Src\controller\RESTBase;

abstract class BaseController extends RESTBase {

    public function __construct() {
        parent::__construct();
    }

    //To be implemented by all individual control classes
    abstract public function handle($func);
}
?>