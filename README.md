# Docusign REST API (code sample)

## Notes:

- Accepts incoming JSON data, internally makes http request to Docusign to create and send Document Envelope, returns JSON response
- Extensible by adding new API routes for new Documents, adding a corresponding RouteHandler class to build and customize the document, and by building out the data models based on Docusign structures.
- Uses composer to manage dependencies (in this case, only Guzzle Http Client)