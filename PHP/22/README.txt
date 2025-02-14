
# PHP Automated Invoice Generator

## Requirements
- PHP >= 7.4
- mPDF Library installed (`composer require mpdf/mpdf`)

## Setup
1. Ensure `pdfs/` directory is writable.
2. Run a local PHP server (`php -S localhost:8000 -t .`).
3. Open `http://localhost:8000/index.html` to generate invoices.

## Features
- Generates invoices dynamically.
- Saves PDFs to the `pdfs/` directory.
- Provides download link after generation.
    