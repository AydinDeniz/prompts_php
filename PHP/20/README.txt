
# Secure Login with Multi-Factor Authentication (MFA)

## Requirements
- PHP >= 7.4
- MySQL database

## Setup
1. Create the `users` table using the `create_table.sql` script.
2. Use `register.php` to register a new user.
3. Log in using `login.php` to receive a simulated MFA code.
4. Use `verify_mfa.php` to verify the MFA code and complete the login.

## Usage
1. `register.php`: Register a new user by providing `email` and `password`.
2. `login.php`: Log in with `email` and `password` to receive an MFA code.
3. `verify_mfa.php`: Verify the `email` and `mfa_code` to complete login.

For production, replace the MFA code output with an actual email or SMS API.
    