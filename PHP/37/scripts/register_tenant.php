
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->company_name) && !empty($data->subdomain) && !empty($data->email)) {
    $database = new Database();
    $db = $database->getConnection();

    $tenant_db_name = "tenant_" . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $data->subdomain));
    $query = "INSERT INTO tenants (company_name, subdomain, email, database_name) VALUES (:company_name, :subdomain, :email, :database_name)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":company_name", $data->company_name);
    $stmt->bindParam(":subdomain", $data->subdomain);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":database_name", $tenant_db_name);

    if ($stmt->execute()) {
        mkdir("../tenants/" . $data->subdomain, 0777, true);
        echo json_encode(["message" => "Tenant registered successfully", "subdomain" => $data->subdomain]);
    } else {
        echo json_encode(["message" => "Registration failed"]);
    }
}
?>
    