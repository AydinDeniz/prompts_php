
# PHP Multi-Tenant SaaS Application with Billing System

## Features
- Supports multiple tenants with separate subdomains.
- Stores tenant information in a database.
- Generates invoices for tenant subscriptions.

## Setup
1. Create the `tenants` and `invoices` tables using `create_tables.sql`.
2. Run a local PHP server (`php -S localhost:8000 -t client/`).
3. Open `http://localhost:8000/index.html` to register tenants and generate invoices.

## Customization
- Integrate Stripe or PayPal for payment processing.
- Implement tenant-specific dashboards.
    