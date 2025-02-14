
# PHP Background Job Processing with RabbitMQ

## Requirements
- PHP >= 7.4
- RabbitMQ installed and running
- PHP AMQP Library (`php-amqplib/php-amqplib`)

## Setup
1. Run `composer require php-amqplib/php-amqplib` in the project directory to install the library.
2. Start RabbitMQ server (`rabbitmq-server`).
3. Create the `jobs` table using `create_tables.sql` in your database.

## Running
1. Start the worker with `php scripts/worker.php`.
2. Run `php scripts/producer.php` to add a job to the queue.
3. Check the database for job status updates.
    