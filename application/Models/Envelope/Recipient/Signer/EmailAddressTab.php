<?php
namespace Docusign\Models\Envelope\Recipient\Signer;
use Docusign\Models\RequestObject;

class EmailAddressTab extends RequestObject
{
    public $anchorString;
    public $anchorXOffset;
    public $anchorYOffset;
    public $font;
    public $fontSize;
    public $name;
    public $recipientId;
    public $tabLabel;
}