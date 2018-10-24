<?php
namespace Docusign\Models\Envelope;
use Docusign\Models\RequestObject;

// https://docs.docusign.com/esign/restapi/Envelopes/Envelopes/create/#definitions
class Document extends RequestObject
{
    public $applyAnchorTabs;
    public $authoritativeCopy;
    public $display;
    public $modal;
    public $download;
    public $inline;
    public $documentBase64;
    public $documentGroup;
    public $documentId;
    public $encryptedWithKeyManager;
    public $fileExtension;
    public $fileFormatHint;
    public $includeInDownload;
    public $matchBoxes;
    public $name;
    public $order;
    public $pages;
    public $password;
    public $remoteUrl;
    public $signerMustAcknowledge;
    public $view;
    public $accept;
    public $view_accept;
    public $templateLocked;
    public $templateRequired;
    public $transformPdfFields;
    public $uri;
}