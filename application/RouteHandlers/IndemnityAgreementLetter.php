<?php
namespace Docusign\RouteHandlers;
use Docusign\Models\ApiRequest\Envelopes AS ApiRequest_Envelopes;
use Docusign\Models\Envelope;
use Docusign\RouteHandler;

class IndemnityAgreementLetter extends RouteHandler
{
    public function generateAndSendSigningRequest(): array
    {
        $envelope = new Envelope();

        $envelope->status = "sent";
        $envelope->emailSubject = "Request a signature via email example";
        $envelope->emailBlurb = "Please review and sign the attached Indemnity Agreement.";

        $document = new Envelope\Document();
        $document->documentId = "1";
        $document->name = "contract.pdf";
        $document->documentBase64 = $this->_requestData["pdf_data"];
        $envelope->documents[] = $document;

        $signer = new Envelope\Recipient\Signer();
        $signer->name = $this->_requestData["full_name"];
        $signer->email = $this->_requestData["email"];
        $signer->recipientId = "1";

        $fullNameTab = new Envelope\Recipient\Signer\FullNameTab();
        $fullNameTab->anchorString = "indemnityPrint";
        $fullNameTab->anchorXOffset = "5";
        $fullNameTab->anchorYOffset = "-5";
        $fullNameTab->font = "Arial";
        $fullNameTab->fontSize = "Size10";
        $fullNameTab->name = "Full Name";
        $fullNameTab->recipientId = "1";
        $fullNameTab->tabLabel = "Full Name";

        $signer->tabs["fullNameTabs"][] = $fullNameTab;

        $signHereTab = new Envelope\Recipient\Signer\SignHereTab();
        $signHereTab->anchorString = "indemnitySign";
        $signHereTab->anchorUnits = "mms";
        $signHereTab->anchorXOffset = "0";
        $signHereTab->anchorYOffset = "0";
        $signHereTab->name = "Please sign here";
        $signHereTab->optional = "false";
        $signHereTab->recipientId = "1";
        $signHereTab->scaleValue = 1;
        $signHereTab->tabLabel = "Signature Field";

        $signer->tabs["signHereTabs"][] = $signHereTab;

        $dateSignedTab = new Envelope\Recipient\Signer\DateSignedTab();
        $dateSignedTab->anchorString = "indemnityDateSigned";
        $dateSignedTab->anchorUnits = "mms";
        $dateSignedTab->anchorXOffset = "1";
        $dateSignedTab->anchorYOffset = "-1";
        $dateSignedTab->font = "Arial";
        $dateSignedTab->fontSize = "Size10";
        $dateSignedTab->name = "Date Signed";
        $dateSignedTab->recipientId = "1";
        $dateSignedTab->tabLabel = "Date Signed";

        $signer->tabs["dateSignedTabs"][] = $dateSignedTab;

        $textTab = new Envelope\Recipient\Signer\TextTab();
        $textTab->anchorString = "indemnityTaxId";
        $textTab->anchorUnits = "mms";
        $textTab->anchorXOffset = "0";
        $textTab->anchorYOffset = "-2";
        $textTab->font = "Arial";
        $textTab->fontSize = "Size10";
        $textTab->name = "Tax ID";
        $textTab->recipientId = "1";
        $textTab->required = "false";
        $textTab->tabLabel = "Tax ID";
        $textTab->height = 3;
        $textTab->width = 150;

        $signer->tabs["textTabs"][] = $textTab;

        $approveTab = new Envelope\Recipient\Signer\ApproveTab();
        $approveTab->pageNumber = 1;
        $approveTab->buttonText = "I have read this letter";
        $approveTab->documentId = 1;
        $approveTab->xPosition = "250";
        $approveTab->yPosition = "700";
        //$approveTab->anchorString = "P1.";
        $approveTab->recipientId = "1";
        $approveTab->tabLabel = "Click to acknowledge";
        $approveTab->font = "Arial";
        $approveTab->fontSize = "Size10";
        $approveTab->width = 125;
        $approveTab->height = 25;

        $signer->tabs["approveTabs"][] = $approveTab;

        $envelope->recipients["signers"][] = $signer;

        $assignedAdjusterField = new Envelope\CustomFields\TextCustomField();
        $assignedAdjusterField->name = "assigned_adjuster";
        $assignedAdjusterField->value = $this->_requestData["assigned_adjuster"];
        $assignedAdjusterField->required = true;
        $assignedAdjusterField->show = false;

        $prefixField = new Envelope\CustomFields\TextCustomField();
        $prefixField->name = "prefix";
        $prefixField->value = $this->_requestData["prefix"];
        $prefixField->required = true;
        $prefixField->show = false;

        $claimNumberField = new Envelope\CustomFields\TextCustomField();
        $claimNumberField->name = "claim_number";
        $claimNumberField->value = $this->_requestData["claim_number"];
        $claimNumberField->required = true;
        $claimNumberField->show = false;

        $claimantField = new Envelope\CustomFields\TextCustomField();
        $claimantField->name = "claimant";
        $claimantField->value = $this->_requestData["claimant"];
        $claimantField->required = true;
        $claimantField->show = false;

        $coverageTypeField = new Envelope\CustomFields\TextCustomField();
        $coverageTypeField->name = "coverage_type";
        $coverageTypeField->value = $this->_requestData["coverage_type"];
        $coverageTypeField->required = true;
        $coverageTypeField->show = false;

        $envelope->customFields["textCustomFields"][] = $assignedAdjusterField;
        $envelope->customFields["textCustomFields"][] = $prefixField;
        $envelope->customFields["textCustomFields"][] = $claimNumberField;
        $envelope->customFields["textCustomFields"][] = $claimantField;
        $envelope->customFields["textCustomFields"][] = $coverageTypeField;

        $apiRequest = new ApiRequest_Envelopes();

        $apiRequest->SetRequestBody(json_encode($envelope));

        return $apiRequest->Call()->GetResponse();
    }
}