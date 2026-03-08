<?php
require 'config.php';

// Fetch customers
$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch menu items
$stmt = $pdo->query("SELECT * FROM menuitems");
$menuitems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch orders with customer and menu item details
$stmt = $pdo->query("SELECT o.order_id, o.customer_id, o.item_id, c.first_name, c.last_name, m.dish_name, m.price, o.order_date, o.quantity, (m.price * o.quantity) as total_price
FROM orders o
INNER JOIN customers c ON o.customer_id = c.customer_id
INNER JOIN menuitems m ON o.item_id = m.item_id");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch dropdowns for forms
$customers_dropdown = $pdo->query("SELECT customer_id, first_name, last_name FROM customers")->fetchAll(PDO::FETCH_ASSOC);
$menuitems_dropdown = $pdo->query("SELECT item_id, dish_name, price FROM menuitems")->fetchAll(PDO::FETCH_ASSOC);

// Fetch edit data
$editData = null;
if (isset($editType) && isset($editId)) {
    if ($editType == 'customer') {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE customer_id = ?");
        $stmt->execute([$editId]);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($editType == 'menuitem') {
        $stmt = $pdo->prepare("SELECT * FROM menuitems WHERE item_id = ?");
        $stmt->execute([$editId]);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($editType == 'order') {
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->execute([$editId]);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>