<?php
require 'config.php';

if (isset($_GET['delete_type']) && isset($_GET['delete_id'])) {
    $type = $_GET['delete_type'];
    $id = $_GET['delete_id'];

    if ($type == 'customer') {
        $stmt = $pdo->prepare("DELETE FROM customers WHERE customer_id = ?");
        $stmt->execute([$id]);
        $redirect_tab = 'customers';
    }
    elseif ($type == 'menuitem') {
        $stmt = $pdo->prepare("DELETE FROM menuitems WHERE item_id = ?");
        $stmt->execute([$id]);
        $redirect_tab = 'menuitems';
    }
    elseif ($type == 'order') {
        $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->execute([$id]);
        $redirect_tab = 'orders';
    }

    header("Location: main.php?tab=" . $redirect_tab);
    exit();
}
?>