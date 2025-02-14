
# Blockchain-Based PHP Authentication System

## Features
- Stores user authentication data as blockchain hashes.
- Ensures tamper-proof login verification.
- Uses SHA-256 cryptographic hashing.

## Setup
1. Create the `users` table using `create_tables.sql`.
2. Ensure the `blockchain.txt` file is writable.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to register and log in.

## Customization
- Add multi-factor authentication.
- Encrypt stored passwords using stronger hashing methods.
    