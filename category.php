<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();
$category = $_GET['name'];

$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);

?>
<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="text-center fw-bold"><?php echo $category ?></h1>
        </div>
    </div>
    <div class="row">
        <h2 class="fw-bold mb-3">Products</h2>
        <?php foreach($products->getByCategory($category) as $product): ?>
        <div class="col-md-3 mb-4">
            <div class="product-card card border-0 shadow-sm">
                <img src="<?php echo $product['image_path'] ?>" class="card-img-top" alt="...">
                <div class="card-body p-3">
                    <h5 class="card-title fw-bold"><?php echo $product['name'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-orange fw-bold"><?php echo $formattedAmount = $pesoFormatter->formatCurrency($product['price'], 'PHP') ?></h6>
                    <p class="card-text text-muted"><?php echo substr($product['description'], 0, 50) . '...' ?></p>
                    <div class="d-flex justify-content-between">
                        <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-link text-secondary">View Product</a>
                        <a href="cart.php?product_id=<?php echo $product['id'] ?>" class="btn btn-orange rounded-pill">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php template('footer.php'); ?>