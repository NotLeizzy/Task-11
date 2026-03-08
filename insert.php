<?php

if (isset($_POST['insert_submit'])) {
    $type = $_POST['insert_type'];

    if ($type == 'customer') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];

        $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, phone_number) VALUES (?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone_number]);
        $redirect_tab = 'customers';
    }
    elseif ($type == 'menuitem') {
        $dish_name = $_POST['dish_name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $stmt = $pdo->prepare("INSERT INTO menuitems (dish_name, price, category) VALUES (?, ?, ?)");
        $stmt->execute([$dish_name, $price, $category]);
        $redirect_tab = 'menuitems';
    }
    elseif ($type == 'order') {
        $customer_id = $_POST['customer_id'];
        $item_id = $_POST['item_id'];
        $order_date = $_POST['order_date'];
        $quantity = $_POST['quantity'];

        $stmt = $pdo->prepare("INSERT INTO orders (customer_id, item_id, order_date, quantity) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_id, $item_id, $order_date, $quantity]);
        $redirect_tab = 'orders';
    }

    header("Location: main.php?tab=" . $redirect_tab);
    exit();
}

?>
