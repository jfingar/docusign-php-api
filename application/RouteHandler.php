<?php
namespace Docusign;

abstract class RouteHandler
{
    protected $_requestData;
    protected $_requestJson;
    protected $_queryStringParams = [];

    public function __construct()
    {
        if(in_array($_SERVER["REQUEST_METHOD"], ["POST", "PUT", "PATCH"])){
            $this->_requestJson = file_get_contents("php://input");
            $requestData = json_decode($this->_requestJson, true);
            if(!$requestData){
                throw new \Exception("Invalid JSON request");
            }
            $this->_requestData = $requestData;
        }
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            foreach($_GET as $key => $value){
                $this->_queryStringParams[$key] = $value;
            }
        }
    }
}