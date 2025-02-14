
# IoT-Based PHP Dashboard for Smart Devices

## Features
- Receives IoT sensor data via API.
- Stores sensor data in a database.
- Displays real-time sensor readings in a web dashboard.

## Setup
1. Create the `sensor_data` table using `create_tables.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to view sensor data.

## Customization
- Extend `store_data.php` to process more sensor types.
- Add MQTT/WebSockets for real-time updates.
    