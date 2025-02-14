
# Automated PHP-Based Fleet Management and GPS Tracking System

## Features
- Tracks and updates vehicle locations in real-time.
- Displays latest locations of fleet vehicles on the dashboard.
- Simple frontend interface for fleet management.

## Setup
1. Create the tables using `create_tables.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to monitor fleet locations.

## Customization
- Integrate Google Maps API for visual tracking.
- Add real-time tracking updates using WebSockets.
    