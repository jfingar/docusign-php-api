<?php
namespace Docusign\Models\Envelope\CustomFields;
use Docusign\Models\RequestObject;

class TextCustomField extends RequestObject
{
    public $fieldId;
	public $name;
	public $show;
	public $required;
	public $value;
	public $configurationType;
	public $errorDetails = ["errorCode" => "", "message" => ""];
}