<?php
namespace Docusign\Models\Envelope\Recipient\Signer;
use Docusign\Models\RequestObject;

class SignHereTab extends RequestObject
{
    public $anchorString;
    public $anchorUnits;
    public $anchorYOffset;
    public $anchorXOffset;
    public $name;
    public $optional;
    public $recipientId;
    public $scaleValue;
    public $tabLabel;
}