
# Fully Automated PHP-Powered NFT Marketplace

## Features
- Mint NFTs by uploading images and metadata.
- Lists all minted NFTs in a marketplace-style UI.
- Generates unique NFT token IDs.

## Setup
1. Create the `nfts` table using `create_tables.sql`.
2. Ensure the `uploads/` directory is writable.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to mint and view NFTs.

## Customization
- Integrate with blockchain smart contracts for real NFT minting.
- Add a marketplace feature to buy and sell NFTs.
    