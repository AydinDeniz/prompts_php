
# Decentralized Identity Verification System with Blockchain

## Features
- Registers and stores user identities in a blockchain ledger.
- Verifies user identity by checking the stored hash against the blockchain.
- Ensures decentralized and tamper-proof identity verification.

## Setup
1. Create the `identities` table using `create_tables.sql`.
2. Ensure the `ledger.txt` file is writable.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to register and verify identities.

## Customization
- Extend to support biometric authentication.
- Use smart contracts for enhanced security.
    