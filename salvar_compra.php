
<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['produtos'])) {
    $_SESSION['produtos_comprados'] = $data['produtos'];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
