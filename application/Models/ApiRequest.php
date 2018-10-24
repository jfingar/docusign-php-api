<?php
namespace Docusign\Models;
use Docusign\Config;
use GuzzleHttp\Client;

/**
 * Class Fl_Docusign_ApiRequest
 *
 * Base class for Docusign API calls
 *
 * Concrete classes must define protected property $_endpoint
 * Concrete classes must define protected property $_requestType (POST, GET, PUT, PATCH or DELETE)
 * Concrete classes where $_requestType is POST, PUT, or PATCH must call SetRequestBody($body) where $body is an array or a valid JSON string
 *
 * example usage:
 *
 *  GET:
 * ---------------------------------
 *  $apiRequest = new Docusgin\Models\ApiRequest\TestConnection();
 *  $apiResponse = $apiRequest->Call()->GetResponse();
 *
 *
 *  POST:
 * ----------------------------------
 * $apiRequest = new Docusign\Models\ApiRequest\Envelopes();
 *
 * // json string
 * $data = '{"someTestData" : "someValue"}';
 * OR
 * // array
 * $data = ["someTestData" => "somevalue"];
 *
 * $apiRequest->SetRequestBody($data);
 * $apiResponse = $apiRequest->Call()->GetResponse();
 *
 */
abstract class ApiRequest
{
    protected $_httpClient;
    protected $_response;
    protected $_requestBody;

    private $_httpHeaders = [];

    public function __construct()
    {
        if($this->_endpoint === null){
            throw new \Exception("No endpoint defined in concrete class.");
        }
        if(!in_array(strtoupper($this->_requestType), ["POST", "GET", "PUT", "PATCH", "DELETE"])){
            throw new \Exception("Invalid http request type defined in concrete class.");
        }

        $credentials = [
            "Username" => Config::GetValue("docusign_username"),
            "Password" => Config::GetValue("docusign_password"),
            "IntegratorKey" => Config::GetValue("docusign_integrator_key")
        ];
        $this->_httpClient = new Client([
            "base_uri" => Config::GetValue("docusign_url_base") . Config::GetValue("docusign_account_id") . '/'
        ]);

        $this->_httpHeaders = [
            "X-DocuSign-Authentication" => json_encode($credentials)
        ];
    }

    public function SetRequestBody($requestBody): ApiRequest
    {
        if(is_array($requestBody)){
            $this->_requestBody = json_encode($requestBody);
        }
        if(is_string($requestBody)){
            $this->_requestBody = $requestBody;
        }
        return $this;
    }

    public function Call(): ApiRequest
    {
        if(in_array($this->_requestType, ["POST", "PUT", "PATCH"])){
            if(!$this->_requestBody || !json_decode($this->_requestBody)){
                throw new \Exception("HTTP methods POST, PUT, or PATCH must define a request body as a valid json string. Use SetRequestBody method.");
            }
        }

        $this->_response = $this->_httpClient->request($this->_requestType, $this->_endpoint, [
            "body" => $this->_requestBody,
            "headers" => $this->_httpHeaders
        ]);

        return $this;
    }

    public function GetJsonResponse(): string
    {
        return $this->_response->getBody();
    }

    public function GetResponse(): array
    {
        return json_decode($this->_response->getBody(), true);
    }
}