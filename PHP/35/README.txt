
# Voice-Controlled PHP Web Application

## Features
- Uses browser speech recognition to capture voice commands.
- Sends commands to a PHP script for processing.
- Returns dynamic responses based on recognized keywords.

## Setup
1. Run a local PHP server (`php -S localhost:8000 -t .`).
2. Open `http://localhost:8000/index.html`.
3. Click "Start Listening" and speak a command (e.g., "What time is it?").

## Customization
- Extend `process_command.php` to support more voice commands.
- Integrate with APIs for real-time weather, news, etc.
    