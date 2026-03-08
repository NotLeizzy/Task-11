<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];

    if ($type == 'customer') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];

        $stmt = $pdo->prepare("UPDATE customers SET first_name = ?, last_name = ?, phone_number = ? WHERE customer_id = ?");
        $stmt->execute([$first_name, $last_name, $phone_number, $id]);
    }
    elseif ($type == 'menuitem') {
        $dish_name = $_POST['dish_name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $stmt = $pdo->prepare("UPDATE menuitems SET dish_name = ?, price = ?, category = ? WHERE item_id = ?");
        $stmt->execute([$dish_name, $price, $category, $id]);
    }
    elseif ($type == 'order') {
        $customer_id = $_POST['customer_id'];
        $item_id = $_POST['item_id'];
        $order_date = $_POST['order_date'];
        $quantity = $_POST['quantity'];

        $stmt = $pdo->prepare("UPDATE orders SET customer_id = ?, item_id = ?, order_date = ?, quantity = ? WHERE order_id = ?");
        $stmt->execute([$customer_id, $item_id, $order_date, $quantity, $id]);
    }

    header("Location: main.php?tab=" . $_POST['type'] . "s");
    exit();
}

?>