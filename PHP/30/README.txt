
# PHP E-Learning Platform with Video Streaming

## Features
- Displays available courses with video streaming.
- Allows users to upload new video content.

## Setup
1. Create the `videos` table using `create_tables.sql`.
2. Ensure the `videos/` directory is writable.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to stream and upload videos.

## Customization
- Add user authentication for content restriction.
- Implement video progress tracking in the database.
    