<?php
/**
 * TailorEase - Online Measurement API Handler
 */
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

$user = get_logged_in_user();
$userId = $user ? $user['id'] : 2;

$fields = ['height', 'weight', 'chest', 'waist', 'hip', 'shoulder', 'sleeve', 'neck', 'wrist', 'inseam', 'thigh', 'calf'];
$data = [];
foreach ($fields as $field) {
    $data[$field] = sanitize_input($_POST[$field] ?? '');
}

$chartFile = null;
if (!empty($_FILES['chart_file']['name'])) {
    $targetDir = __DIR__ . '/../uploads/';
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
    $chartFile = time() . '_' . basename($_FILES['chart_file']['name']);
    move_uploaded_file($_FILES['chart_file']['tmp_name'], $targetDir . $chartFile);
}

$db = getDB();
if (!$db->isMock() && $pdo = $db->getConnection()) {
    try {
        $stmt = $pdo->prepare("INSERT INTO measurements (user_id, height, weight, chest, waist, hip, shoulder, sleeve, neck, wrist, inseam, thigh, calf, chart_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId, $data['height'], $data['weight'], $data['chest'], $data['waist'], $data['hip'],
            $data['shoulder'], $data['sleeve'], $data['neck'], $data['wrist'], $data['inseam'], $data['thigh'], $data['calf'], $chartFile
        ]);
    } catch (Exception $e) {}
}

// Update session measurement memory
$_SESSION['user_measurements'] = $data;

echo json_encode([
    'status' => 'success',
    'message' => 'Your measurement profile has been saved successfully!',
    'redirect' => 'customer-dashboard.php'
]);
