
# Secure Digital Document Management System with PHP and QR Code Verification

## Features
- Upload and store digital documents securely.
- Generate a QR code for each document for verification.
- Verify document authenticity via the QR code.

## Setup
1. Install dependencies: `pip install qrcode[pil]`.
2. Create the `documents` table using `create_tables.sql`.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to upload and verify documents.

## Customization
- Add document encryption for enhanced security.
- Implement user authentication for access control.
    