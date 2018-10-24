<?php
/**
 * Created by PhpStorm.
 * User: bribri
 * Date: 8/27/18
 * Time: 3:08 PM
 */
namespace Docusign\RouteHandlers;
use Docusign\Models\ApiRequest\Envelopes AS ApiRequest_Envelopes;
use Docusign\Models\Envelope;
use Docusign\RouteHandler;

class ConsentForms extends RouteHandler
{
    public function generateAndSendSigningRequest(): array
    {
        $envelope = new Envelope();

        $envelope->status = "sent";
        $envelope->emailSubject = "Request a signature via email example";
        $envelope->emailBlurb = "Please review and sign the attached Electronic Document Consent Form";

        $document = new Envelope\Document();
        $document->documentId = "1";
        $document->name = "Loya Electronic Document Consent Form.pdf";
        $document->documentBase64 = $this->_requestData["pdf_data"];
        $envelope->documents[] = $document;

        $signer = new Envelope\Recipient\Signer();
        $signer->name = $this->_requestData["full_name"];
        $signer->email = $this->_requestData["email"];
        $signer->recipientId = "1";

        $fullNameTab = new Envelope\Recipient\Signer\FullNameTab();
        $fullNameTab->anchorString = "consentFullName";
        $fullNameTab->anchorXOffset = "5";
        $fullNameTab->anchorYOffset = "-5";
        $fullNameTab->font = "Arial";
        $fullNameTab->fontSize = "Size10";
        $fullNameTab->name = "Full Name";
        $fullNameTab->recipientId = "1";
        $fullNameTab->tabLabel = "Full Name";

        $signer->tabs["fullNameTabs"][] = $fullNameTab;

        $signHereTab = new Envelope\Recipient\Signer\SignHereTab();
        $signHereTab->anchorString = "consentSignature";
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
        $dateSignedTab->anchorString = "consentDate";
        $dateSignedTab->anchorUnits = "mms";
        $dateSignedTab->anchorXOffset = "5";
        $dateSignedTab->anchorYOffset = "-5";
        $dateSignedTab->font = "Arial";
        $dateSignedTab->fontSize = "Size10";
        $dateSignedTab->name = "Date Signed";
        $dateSignedTab->recipientId = "1";
        $dateSignedTab->tabLabel = "Date Signed";

        $signer->tabs["dateSignedTabs"][] = $dateSignedTab;

        $emailAddressTab = new Envelope\Recipient\Signer\EmailAddressTab();
        $emailAddressTab->anchorString = "consentEmailAddress";
        $emailAddressTab->anchorXOffset = "5";
        $emailAddressTab->anchorYOffset = "-5";
        $emailAddressTab->font = "Arial";
        $emailAddressTab->fontSize = "Size10";
        $emailAddressTab->name = "Full Name";
        $emailAddressTab->recipientId = "1";
        $emailAddressTab->tabLabel = "Email Address";

        $signer->tabs["emailAddressTabs"][] = $emailAddressTab;

        $envelope->recipients["signers"][] = $signer;

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

        $envelope->customFields["textCustomFields"][] = $prefixField;
        $envelope->customFields["textCustomFields"][] = $claimNumberField;
        $envelope->customFields["textCustomFields"][] = $claimantField;
        $envelope->customFields["textCustomFields"][] = $coverageTypeField;

        $apiRequest = new ApiRequest_Envelopes();

        $apiRequest->SetRequestBody(json_encode($envelope));

        return $apiRequest->Call()->GetResponse();
    }
}