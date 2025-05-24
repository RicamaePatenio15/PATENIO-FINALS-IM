<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php

if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        echo "<script>alert('Product removed from cart');</script>";
    }
}

$amountLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amountLocale, NumberFormatter::CURRENCY);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="cart-header mb-4">
                <h2 class="fw-bold">Cart</h2>
            </div>
            <?php if (countCart() == 0): ?>
                <div class="empty-cart text-center py-5">
                   <i class="fas fa-shopping-cart fa-5x text-muted"></i>
                    <p class="text-muted">Your cart is empty.</p>
                    <a href="index.php" class="btn btn-orange rounded-pill">Continue Shopping</a>
                </div>
            <?php else: ?>
                <div class="cart-table bg-white p-4 rounded-3 shadow-sm">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <tr>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['quantity'] ?></td>
                                    <td><?php echo $pesoFormatter->formatCurrency($item['price'], 'PHP') ?></td>
                                    <td><?php echo $pesoFormatter->formatCurrency($item['total'], 'PHP') ?></td>
                                    <td>
                                        <a href="cart.php?remove=<?php echo $item['product_id'] ?>" class="btn btn-link text-danger">Remove</a>
                                    </td>
                                    <?php $superTotal = isset($superTotal) ? $superTotal + $item['total'] : $item['total']; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td colspan="2"><strong><?php echo $pesoFormatter->formatCurrency($superTotal, 'PHP') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart-actions mt-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="checkout.php" class="btn btn-orange rounded-pill">Checkout</a>
                    <?php else: ?>
                        <div class="alert alert-warning">Please log in to proceed to checkout.</div>
                        <a href="login.php" class="btn btn-warning rounded-pill">Login</a>
                    <?php endif; ?>

                    <a href="index.php" class="btn btn-link text-secondary">Continue Shopping</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>