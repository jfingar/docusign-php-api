<?php
namespace Docusign\Models\Envelope\Recipient\Signer;
use Docusign\Models\RequestObject;

class DateSignedTab extends RequestObject
{
	public $anchorString;
	public $anchorUnits;
	public $anchorYOffset;
	public $anchorXOffset;
	public $name;
	public $font;
	public $fontSize;
	public $recipientId;
	public $tabLabel;
}