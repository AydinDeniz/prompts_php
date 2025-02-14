
# Decentralized PHP-Based Voting System with Blockchain Transparency

## Features
- Registers and stores votes securely in a blockchain ledger.
- Ensures tamper-proof verification by checking vote hashes.
- Provides a transparent voting system with decentralized verification.

## Setup
1. Create the `votes` table using `create_tables.sql`.
2. Ensure the `ledger.txt` file is writable.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to vote and verify votes.

## Customization
- Extend to support multiple elections.
- Implement voter authentication to prevent duplicate votes.
    