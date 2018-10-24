<?php
namespace Docusign\Models;

class Envelope extends RequestObject
{
    public $status;
    public $emailSubject;
    public $emailBlurb;
    public $documents = [];
    public $recipients = ["signers" => []];
    public $customFields = ["textCustomFields" => [], "listCustomFields" => []];
}