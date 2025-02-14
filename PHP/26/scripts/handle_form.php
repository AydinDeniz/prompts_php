
<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = json_decode(file_get_contents("php://input"), true);
    $errors = [];

    foreach ($formData as $field) {
        if (isset($field['required']) && $field['required'] && empty($field['value'])) {
            $errors[] = "{$field['label']} is required.";
        }
        if ($field['type'] == 'email' && !filter_var($field['value'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "{$field['label']} must be a valid email.";
        }
    }

    if (!empty($errors)) {
        echo json_encode(["status" => "error", "messages" => $errors]);
    } else {
        echo json_encode(["status" => "success", "message" => "Form submitted successfully."]);
    }
}
?>
    