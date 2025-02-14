
# Smart PHP Inventory Management System with IoT Integration

## Features
- Monitors real-time stock levels using IoT sensors.
- Updates inventory data automatically based on incoming data.
- Displays stock levels through a simple web dashboard.

## Setup
1. Create the `inventory` table using `create_tables.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to view inventory levels.

## Customization
- Integrate IoT sensors for automatic stock updates.
- Implement low-stock alerts for automatic restocking.
    