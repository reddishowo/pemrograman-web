<?php
namespace Controller;

abstract class Controller {
    protected $controllerName;
    protected $controllerMethod;
    
    protected function getControllerAttribute() {
        return [
            "controller_name" => $this->controllerName,
            "controller_method" => $this->controllerMethod
        ];
    }
}