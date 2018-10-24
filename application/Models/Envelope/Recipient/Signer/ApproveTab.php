<?php
namespace Docusign\Models\Envelope\Recipient\Signer;
use Docusign\Models\RequestObject;

class ApproveTab extends RequestObject
{
	public $anchorString;
	public $anchorUnits;
	public $anchorYOffset;
	public $anchorXOffset;
	public $font;
	public $fontColor;
	public $fontSize;
	public $recipientId;
	public $tabId;
	public $tabLabel;
	public $xPosition;
	public $yPosition;
	public $buttonText;
	public $width;
	public $height;
	public $pageNumber;
	public $documentId;
}