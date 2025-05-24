<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Checkout;
$orders = new Checkout();

?>
<div class="container my-5">
    <h2 class="fw-bold mb-4">Order History</h2>
    <div class="order-history-card card shadow-sm p-4">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orders->getAllOrders() as $order) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($order['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['user_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['product_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['quantity']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['total_price']) . '</td>';
                    echo '<td>' . htmlspecialchars($order['order_date']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php template('footer.php'); ?>