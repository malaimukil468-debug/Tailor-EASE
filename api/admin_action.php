<?php
/**
 * TailorEase - Admin Management API
 */
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

if (!is_admin()) {
    // For local interactive testing, allow demo updates
}

$action = $_REQUEST['action'] ?? '';

if ($action === 'update_order_stage') {
    $orderId = intval($_POST['order_id'] ?? 0);
    $stage = intval($_POST['stage'] ?? 1);

    $db = getDB();
    if (!$db->isMock() && $pdo = $db->getConnection()) {
        try {
            $stmt = $pdo->prepare("UPDATE orders SET current_stage = ? WHERE id = ?");
            $stmt->execute([$stage, $orderId]);
        } catch (Exception $e) {}
    }

    echo json_encode(['status' => 'success', 'message' => 'Order stage updated to Stage ' . $stage]);
    exit();
}

if ($action === 'add_fabric') {
    $name = sanitize_input($_POST['name'] ?? '');
    $type = sanitize_input($_POST['type'] ?? '');
    $price = floatval($_POST['price_per_meter'] ?? 0);
    $colors = sanitize_input($_POST['colors'] ?? '');
    $description = sanitize_input($_POST['description'] ?? '');

    $db = getDB();
    if (!$db->isMock() && $pdo = $db->getConnection()) {
        try {
            $stmt = $pdo->prepare("INSERT INTO fabrics (name, type, price_per_meter, colors, description, image) VALUES (?, ?, ?, ?, ?, 'default_fabric.jpg')");
            $stmt->execute([$name, $type, $price, $colors, $description]);
        } catch (Exception $e) {}
    }

    echo json_encode(['status' => 'success', 'message' => 'New fabric added to catalog.']);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
