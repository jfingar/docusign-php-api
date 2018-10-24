<?php
namespace Docusign;

class Application
{
    public function __construct()
    {
        spl_autoload_register(function($className){
            $classNameParts = explode("\\", $className);
            $classNamePartsCount = count($classNameParts);

            $includePathString = '';
            foreach($classNameParts as $key => $part){
                if($part === "Docusign"){
                    continue;
                }
                $includePathString .= ($key + 1) === $classNamePartsCount ? $part . ".php" : $part . "/";
            }
            require_once APPLICATION_PATH . "/" . $includePathString;
        });
    }

    public function Route($endpoint, $httpRequestType)
    {
        /** Remove query string **/
        if(strpos($endpoint, "?")){
            $endpoint = strtok($endpoint, "?");
        }

        $routeFound = false;

        $routes = include 'routes.php';
        foreach($routes as $route){
            if($route->Uri === $endpoint && $route->HttpRequestType === $httpRequestType){
                $routeFound = true;
                $routeClassname = 'Docusign\\RouteHandlers\\' . $route->HandlerClass;
                $routeClass = new $routeClassname();
                if($route->RequiresAuth){
                    $headers = getallheaders();
                    $token = isset($headers["Authorization"]) ? $headers["Authorization"] : "";
                    $routeClass->SetAuthToken($token);
                    if(!AuthToken::IsValid($token)){
                        echo json_encode(["status" => false, "error" => "Not Authorized.", "auth_failure" => true]);
                        break;
                    }
                }
                echo json_encode($routeClass->{$route->HandlerMethod}());
                break;
            }
        }

        if(!$routeFound){
            http_response_code(404);
            echo "API ROUTE NOT FOUND.";
        }

    }

}