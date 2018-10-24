<?php
namespace Docusign;

return [
    new Route("indemnity-agreement-letter", "POST", "IndemnityAgreementLetter", "generateAndSendSigningRequest"),
    new Route("consent-forms", "POST", "ConsentForms", "generateAndSendSigningRequest")
];