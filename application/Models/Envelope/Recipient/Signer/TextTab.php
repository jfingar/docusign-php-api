<?php
namespace Docusign\Models\Envelope\Recipient\Signer;
use Docusign\Models\RequestObject;

class TextTab extends RequestObject
{
	public $anchorString;
	public $anchorUnits;
	public $anchorYOffset;
	public $anchorXOffset;
	public $font;
	public $fontSize;
	public $height;
	public $name;
	public $recipientId;
	public $required;
	public $tabLabel;
	public $width;
}