
# PHP URL Shortener

## Features
- Shortens long URLs using a unique code.
- Redirects users to original URLs when accessed.

## Setup
1. Create the `urls` table using `create_table.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t .`).
3. Open `http://localhost:8000/index.html` to shorten URLs.

## Customization
- Change the URL format in `shorten.php`.
- Add user authentication to track shortened URLs.
    