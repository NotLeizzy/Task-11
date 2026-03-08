<?php
require 'config.php'; 

$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'customers';
$editType = isset($_GET['type']) ? $_GET['type'] : null;
$editId = isset($_GET['id']) ? $_GET['id'] : null;

require 'update.php';
require 'delete.php'; 
require 'insert.php';
require 'select.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Restaurant Management System</title>
</head>
<body>
  <h1 class="mb-4">Restaurant Mo</h1>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link <?php echo $activeTab == 'customers' ? 'active' : ''; ?>" href="main.php?tab=customers">Customers</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo $activeTab == 'menuitems' ? 'active' : ''; ?>" href="main.php?tab=menuitems">Menu Items</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo $activeTab == 'orders' ? 'active' : ''; ?>" href="main.php?tab=orders">Orders</a>
    </li>
  </ul>

  <!-- CUSTOMERS TAB -->
  <div class="tab-content <?php echo $activeTab == 'customers' ? 'active' : ''; ?>">
    <div class="row">
      <!-- Form Column -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5><?php echo ($editType == 'customer' && $editData) ? 'Edit Customer' : 'Add New Customer'; ?></h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <?php if ($editType == 'customer' && $editData): ?>
                <input type="hidden" name="type" value="customer">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['customer_id']); ?>">
                <a href="main.php?tab=customers" class="btn btn-secondary btn-sm mb-2">Cancel Edit</a>
              <?php else: ?>
                <input type="hidden" name="insert_type" value="customer">
              <?php endif; ?>
              <div class="mb-3">
                <label for="add_customer_first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="add_customer_first_name" name="first_name" 
                  value="<?php echo ($editType == 'customer' && $editData) ? htmlspecialchars($editData['first_name']) : ''; ?>" required>
              </div>
              <div class="mb-3">
                <label for="add_customer_last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="add_customer_last_name" name="last_name" 
                  value="<?php echo ($editType == 'customer' && $editData) ? htmlspecialchars($editData['last_name']) : ''; ?>" required>
              </div>
              <div class="mb-3">
                <label for="add_customer_phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="add_customer_phone" name="phone_number" 
                  value="<?php echo ($editType == 'customer' && $editData) ? htmlspecialchars($editData['phone_number']) : ''; ?>" required>
              </div>
              <button type="submit" name="<?php echo ($editType == 'customer' && $editData) ? 'submit' : 'insert_submit'; ?>" class="btn btn-primary">
                <?php echo ($editType == 'customer' && $editData) ? 'Update Customer' : 'Add Customer'; ?>
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Table Column -->
      <div class="col-md-9">
        <h2>Customers List</h2>
        <table class="table table-striped table-hover rounded">
          <thead class="table-dark">
            <tr>
              <th>Customer ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
              <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
              <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
              <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
              <td><?php echo htmlspecialchars($customer['phone_number']); ?></td>
              <td>
                <a href="main.php?tab=customers&type=customer&id=<?php echo htmlspecialchars($customer['customer_id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="main.php?delete_type=customer&delete_id=<?php echo htmlspecialchars($customer['customer_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-content <?php echo $activeTab == 'menuitems' ? 'active' : ''; ?>">
    <div class="row">
      <!-- Form Column -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-success text-white">
            <h5><?php echo ($editType == 'menuitem' && $editData) ? 'Edit Menu Item' : 'Add New Dish'; ?></h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <?php if ($editType == 'menuitem' && $editData): ?>
                <input type="hidden" name="type" value="menuitem">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['item_id']); ?>">
                <a href="main.php?tab=menuitems" class="btn btn-secondary btn-sm mb-2">Cancel Edit</a>
              <?php else: ?>
                <input type="hidden" name="insert_type" value="menuitem">
              <?php endif; ?>
              <div class="mb-3">
                <label for="add_dish_name" class="form-label">Dish Name</label>
                <input type="text" class="form-control" id="add_dish_name" name="dish_name" 
                  value="<?php echo ($editType == 'menuitem' && $editData) ? htmlspecialchars($editData['dish_name']) : ''; ?>" required>
              </div>
              <div class="mb-3">
                <label for="add_price" class="form-label">Price</label>
                <input type="number" class="form-control" id="add_price" name="price" step="0.01" 
                  value="<?php echo ($editType == 'menuitem' && $editData) ? htmlspecialchars($editData['price']) : ''; ?>" required>
              </div>
              <div class="mb-3">
                <label for="add_category" class="form-label">Category</label>
                <input type="text" class="form-control" id="add_category" name="category" 
                  value="<?php echo ($editType == 'menuitem' && $editData) ? htmlspecialchars($editData['category']) : ''; ?>" required>
              </div>
              <button type="submit" name="<?php echo ($editType == 'menuitem' && $editData) ? 'submit' : 'insert_submit'; ?>" class="btn btn-success">
                <?php echo ($editType == 'menuitem' && $editData) ? 'Update Dish' : 'Add Dish'; ?>
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Table Column -->
      <div class="col-md-9">
        <h2>Menu Items</h2>
        <table class="table table-striped table-hover rounded">
          <thead class="table-dark">
            <tr>
              <th>Item ID</th>
              <th>Dish Name</th>
              <th>Price</th>
              <th>Category</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($menuitems as $item): ?>
            <tr>
              <td><?php echo htmlspecialchars($item['item_id']); ?></td>
              <td><?php echo htmlspecialchars($item['dish_name']); ?></td>
              <td>$<?php echo htmlspecialchars($item['price']); ?></td>
              <td><?php echo htmlspecialchars($item['category']); ?></td>
              <td>
                <a href="main.php?tab=menuitems&type=menuitem&id=<?php echo htmlspecialchars($item['item_id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="main.php?delete_type=menuitem&delete_id=<?php echo htmlspecialchars($item['item_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ORDERS TAB -->
  <div class="tab-content <?php echo $activeTab == 'orders' ? 'active' : ''; ?>">
    <div class="row">
      <!-- Form Column -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-info text-white">
            <h5><?php echo ($editType == 'order' && $editData) ? 'Edit Order' : 'Add New Order'; ?></h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <?php if ($editType == 'order' && $editData): ?>
                <input type="hidden" name="type" value="order">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['order_id']); ?>">
                <a href="main.php?tab=orders" class="btn btn-secondary btn-sm mb-2">Cancel Edit</a>
              <?php else: ?>
                <input type="hidden" name="insert_type" value="order">
              <?php endif; ?>
              <div class="mb-3">
                <label for="add_order_customer" class="form-label">Customer</label>
                <select class="form-select" id="add_order_customer" name="customer_id" required>
                  <option value="">Select a customer</option>
                  <?php foreach ($customers_dropdown as $cust): ?>
                  <option value="<?php echo htmlspecialchars($cust['customer_id']); ?>" 
                    <?php echo ($editType == 'order' && $editData && $cust['customer_id'] == $editData['customer_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cust['first_name'] . ' ' . $cust['last_name']); ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="add_order_item" class="form-label">Menu Item</label>
                <select class="form-select" id="add_order_item" name="item_id" required>
                  <option value="">Select a menu item</option>
                  <?php foreach ($menuitems_dropdown as $item): ?>
                  <option value="<?php echo htmlspecialchars($item['item_id']); ?>" 
                    <?php echo ($editType == 'order' && $editData && $item['item_id'] == $editData['item_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($item['dish_name'] . ' - $' . $item['price']); ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="add_order_date" class="form-label">Order Date</label>
                <input type="date" class="form-control" id="add_order_date" name="order_date" 
                  value="<?php echo ($editType == 'order' && $editData) ? htmlspecialchars($editData['order_date']) : ''; ?>" required>
              </div>
              <div class="mb-3">
                <label for="add_order_quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="add_order_quantity" name="quantity" min="1" 
                  value="<?php echo ($editType == 'order' && $editData) ? htmlspecialchars($editData['quantity']) : ''; ?>" required>
              </div>
              <button type="submit" name="<?php echo ($editType == 'order' && $editData) ? 'submit' : 'insert_submit'; ?>" class="btn btn-info">
                <?php echo ($editType == 'order' && $editData) ? 'Update Order' : 'Add Order'; ?>
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Table Column -->
      <div class="col-md-9">
        <h2>Orders</h2>
        <table class="table table-striped table-hover rounded">
          <thead class="table-dark">
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th>
              <th>Dish Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Order Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
              <td><?php echo htmlspecialchars($order['order_id']); ?></td>
              <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
              <td><?php echo htmlspecialchars($order['dish_name']); ?></td>
              <td>$<?php echo htmlspecialchars($order['price']); ?></td>
              <td><?php echo htmlspecialchars($order['quantity']); ?></td>
              <td><strong>$<?php echo htmlspecialchars(number_format($order['total_price'], 2)); ?></strong></td>
              <td><?php echo htmlspecialchars($order['order_date']); ?></td>
              <td>
                <a href="main.php?tab=orders&type=order&id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="main.php?delete_type=order&delete_id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>