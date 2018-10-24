<?php
namespace Docusign\Models\Envelope\Recipient;
use Docusign\Models\RequestObject;

class Signer extends RequestObject
{
    public $name;
    public $email;
    public $recipientId;
    public $tabs = [
    		"fullNameTabs" => [],
    		"signHereTabs" => [],
    		"dateSignedTabs" => [],
    		"textTabs" => [],
    		"approveTabs" => []
    	];
}