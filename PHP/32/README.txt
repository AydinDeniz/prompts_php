
# PHP Secure Digital Signature and Document Verification System

## Features
- Signs PDF documents using RSA encryption.
- Verifies document authenticity using public key cryptography.

## Setup
1. Create the `signed_documents` table using `create_tables.sql`.
2. Generate RSA key pair (private and public keys).
3. Replace `[Your private key here]` and `[Your public key here]` with actual keys.
4. Run a local PHP server (`php -S localhost:8000 -t .`).
5. Open `http://localhost:8000/index.html` to sign and verify documents.

## Customization
- Add encryption for document storage.
- Store signed documents securely in a cloud service.
    