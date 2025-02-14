
# PHP Microservices with API Gateway

## Features
- API Gateway that routes requests to microservices.
- Separate User and Order services handling different data.
- Simple JavaScript-based frontend to fetch data.

## Setup
1. Start two local PHP servers:
   - `php -S localhost:8001 -t services/user_service/`
   - `php -S localhost:8002 -t services/order_service/`
2. Start the API Gateway: `php -S localhost:8000 -t api_gateway/`
3. Open `http://localhost:8000/index.html` to test the API Gateway.

## Customization
- Add authentication at the API gateway level.
- Implement database connections for microservices.
- Deploy each service separately using Docker.
    