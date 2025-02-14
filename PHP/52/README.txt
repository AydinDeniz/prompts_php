
# Real-Time PHP Disaster Alert System with Geolocation Integration

## Features
- Fetches real-time disaster alerts based on user location.
- Allows users to report disasters with geolocation data.
- Stores disaster reports in a database for future reference.

## Setup
1. Create the `alerts` table using `create_tables.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to check or report disasters.

## Customization
- Integrate a weather API for automatic disaster detection.
- Implement push notifications for emergency alerts.
    