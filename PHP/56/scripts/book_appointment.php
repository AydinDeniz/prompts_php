
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->patient_name) && !empty($data->doctor) && !empty($data->date)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO appointments (patient_name, doctor, appointment_date) VALUES (:patient_name, :doctor, :appointment_date)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":patient_name", $data->patient_name);
    $stmt->bindParam(":doctor", $data->doctor);
    $stmt->bindParam(":appointment_date", $data->date);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Appointment booked successfully"]);
    } else {
        echo json_encode(["message" => "Failed to book appointment"]);
    }
}
?>
    