
# Serverless PHP Application with AWS Lambda and API Gateway

## Features
- Deploys PHP on AWS Lambda using API Gateway.
- Handles API requests in a serverless environment.
- Uses AWS SDK to manage requests dynamically.

## Setup
1. Install dependencies: `composer require aws/aws-sdk-php`.
2. Zip `lambda/index.php` with `vendor/` and deploy to AWS Lambda.
3. Configure AWS API Gateway to trigger Lambda.
4. Update `index.html` with your API Gateway endpoint.

## Customization
- Expand Lambda function to connect with databases.
- Implement authentication with AWS Cognito.
    