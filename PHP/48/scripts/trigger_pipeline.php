
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $output = shell_exec("bash ../ci_cd/run_pipeline.sh 2>&1");
    echo json_encode(["message" => "Pipeline executed", "output" => $output]);
}
?>
    