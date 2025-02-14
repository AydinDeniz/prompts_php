
# PHP Multi-Language Website

## Features
- Supports multiple languages using JSON files.
- Uses PHP sessions to store selected language.

## Setup
1. Start the PHP server (`php -S localhost:8000`).
2. Open `http://localhost:8000/index.php`.
3. Switch languages using the links provided.

## Adding New Languages
- Add a new JSON file in `languages/` (e.g., `fr.json` for French).
- Copy the structure of `en.json` and translate the content.
- The system will automatically detect the new language.
    