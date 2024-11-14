
<?php
require 'vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
include_once '../config/database.php';

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('email_queue', false, true, false, false);

$data = [
    'email' => 'example@example.com',
    'subject' => 'Welcome to our service',
    'message' => 'Thank you for joining us!'
];

$msg = new AMQPMessage(json_encode($data));
$channel->basic_publish($msg, '', 'email_queue');

// Track job in the database
$database = new Database();
$db = $database->getConnection();
$query = "INSERT INTO jobs (status) VALUES ('queued')";
$db->query($query);

echo "Job added to queue!\n";
$channel->close();
$connection->close();
?>
    