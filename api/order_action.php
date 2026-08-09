<?php
/**
 * TailorEase - Order Processing & Checkout API
 */
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

$user = get_logged_in_user();
$userId = $user ? $user['id'] : 2;

$serviceName = sanitize_input($_POST['service_name'] ?? 'Bespoke Custom Garment');
$fabricId = intval($_POST['fabric_id'] ?? 1);
$expressDelivery = isset($_POST['express_delivery']) ? 1 : 0;
$giftPackage = isset($_POST['gift_package']) ? 1 : 0;
$totalAmount = floatval($_POST['total_amount'] ?? 3500.00);
$address = sanitize_input($_POST['delivery_address'] ?? '42 Rose Garden Street, Coimbatore, TN');

$orderNum = 'ORD-' . date('Y') . '-' . rand(8000, 9999);

$referenceImage = null;
if (!empty($_FILES['dress_image']['name'])) {
    $targetDir = __DIR__ . '/../uploads/';
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
    $referenceImage = time() . '_' . basename($_FILES['dress_image']['name']);
    move_uploaded_file($_FILES['dress_image']['tmp_name'], $targetDir . $referenceImage);
}

$db = getDB();
if (!$db->isMock() && $pdo = $db->getConnection()) {
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (order_number, user_id, service_name, fabric_id, express_delivery, gift_package, total_amount, current_stage, delivery_address, reference_image) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?, ?)");
        $stmt->execute([$orderNum, $userId, $serviceName, $fabricId, $expressDelivery, $giftPackage, $totalAmount, $address, $referenceImage]);
        $orderId = $pdo->lastInsertId();

        // Populate initial tracking step
        $stmtTrack = $pdo->prepare("INSERT INTO order_tracking (order_id, stage_num, stage_title, description, status) VALUES (?, 1, 'Order Received', 'Order confirmed and registered in TailorEase system.', 'completed')");
        $stmtTrack->execute([$orderId]);
    } catch (Exception $e) {}
}

$_SESSION['last_order_num'] = $orderNum;

echo json_encode([
    'status' => 'success',
    'message' => 'Order placed successfully! Order Number: ' . $orderNum,
    'order_number' => $orderNum,
    'redirect' => 'order-track.php?order=' . $orderNum
]);
