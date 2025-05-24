<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();
$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);
?>

<!-- Load external CSS -->
<link rel="stylesheet" href="assets/css/styles.css">

<div class="store-wrapper py-5">
    <div class="container">


        <!-- Product Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-orange">🛒 Products</h2>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($products->getAll() as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <img src="<?php echo $product['image_path'] ?>" class="card-img-top rounded" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <h6 class="text-orange mb-2 fw-bold"><?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?></h6>
                            <p class="card-text mb-4 text-muted">
                                <?php echo strlen($product['description']) > 100 ? substr($product['description'], 0, 100) . '...' : $product['description']; ?>
                            </p>
                            <div class="mt-auto d-grid gap-2">
                                <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-link text-secondary">
                                    <i class="bi bi-eye"></i> View Product
                                </a>
                                <a href="cart.php?product_id=<?php echo $product['id'] ?>" class="btn btn-orange rounded-pill">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>