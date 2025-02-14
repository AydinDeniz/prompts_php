
# AI-Powered Image and Video Content Moderation System

## Features
- Uploads and analyzes images using AI models.
- Identifies unsafe content and flags it.
- Uses a pre-trained ResNet18 model for classification.

## Setup
1. Install dependencies: `pip install torch torchvision pillow`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to upload files.

## Customization
- Train a custom AI model for better accuracy.
- Extend support for video moderation.
    