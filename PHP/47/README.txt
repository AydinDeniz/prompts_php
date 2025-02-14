
# Zero-Trust PHP Authentication System with Multi-Layer Security

## Features
- Uses password-based authentication with OTP verification.
- Generates a secret key for each user during registration.
- Uses Google Authenticator compatible OTP codes.

## Setup
1. Install dependencies: `pip install pyotp`.
2. Create the `users` table using `create_tables.sql`.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to register and log in.

## Customization
- Add biometric authentication for enhanced security.
- Implement adaptive authentication policies based on risk analysis.
    