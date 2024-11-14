
<?php
require 'vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('email_queue', false, true, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
    $data = json_decode($msg->body, true);
    $email = $data['email'];
    $subject = $data['subject'];
    $message = $data['message'];
    
    // Simulate email sending
    echo "Sending email to $email: $subject - $message\n";

    // Update job status in database (simulated)
    include_once '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    $query = "UPDATE jobs SET status = 'completed' WHERE status = 'queued' LIMIT 1";
    $db->query($query);
};

$channel->basic_consume('email_queue', '', false, true, false, false, $callback);

while($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>
    