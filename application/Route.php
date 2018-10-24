<?php
namespace Docusign;

class Route
{
    public $HandlerClass;
    public $HandlerMethod;
    public $Uri;
    public $RequiresAuth;
    public $HttpRequestType;

    private $_allowedHttpRequestTypes = ["POST", "GET", "PUT", "DELETE", "PATCH"];

    public function __construct(string $uri, string $httpRequestType, string $handlerClass, string $handlerMethod, $requiresAuth = false)
    {
        if(!in_array(strtoupper($httpRequestType), $this->_allowedHttpRequestTypes)) {
            throw new \Exception("Invalid HTTP Request Type: " . $httpRequestType);
        }

        $this->Uri = $uri;
        $this->HttpRequestType = strtoupper($httpRequestType);
        $this->HandlerClass = $handlerClass;
        $this->HandlerMethod = $handlerMethod;
        $this->RequiresAuth = $requiresAuth;
    }
}