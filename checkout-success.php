<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<div class="container my-5 text-center">
    <div class="order-success p-5">
        <div class="mb-4">
            <i class="fas fa-check-circle fa-5x text-orange"></i>
        </div>
        <h1 class="text-orange fw-bold">Thank You for Your Order!</h1>
        <p class="text-muted">Your order has been successfully placed. We’ll notify you once it's on the way!</p>
        <a href="index.php" class="btn btn-orange rounded-pill mt-3">Back to Home</a>
    </div>
</div>

<?php template('footer.php'); ?>