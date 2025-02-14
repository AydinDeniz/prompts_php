
# AI-Powered Code Review and Security Analysis System

## Features
- Uploads source code and analyzes it using AI.
- Detects security vulnerabilities like `eval()`, `exec()`, and hardcoded passwords.
- Provides automated code review feedback.

## Setup
1. Install dependencies: `pip install re` (if necessary).
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to upload and review code.

## Customization
- Expand `analyze_code.py` to check for more security issues.
- Integrate AI-powered static analysis tools for deeper insights.
    