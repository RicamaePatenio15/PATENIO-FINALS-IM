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

        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-10">
                <div class="p-5 rounded shadow text-white" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
    <h1 class="display-3 fw-bold">Welcome to the Online Store</h1>
    <p class="lead fs-4">Find the best deals and latest gadgets right here!</p>
</div>
            </div>
        </div>

        <!-- Product Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-secondary">🛒 Products</h2>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($products->getAll() as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <img src="<?php echo $product['image_path'] ?>" class="card-img-top rounded" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <h6 class="text-success mb-2"><?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?></h6>
                            <p class="card-text mb-4 text-muted">
                                <?php echo strlen($product['description']) > 100 ? substr($product['description'], 0, 100) . '...' : $product['description']; ?>
                            </p>
                            <div class="mt-auto d-grid gap-2">
                                <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-primary btn-lg">
                                    <i class="bi bi-eye"></i> View Product
                                </a>
                                <a href="#" class="btn btn-success btn-lg add-to-cart" data-productid="<?php echo $product['id'] ?>" data-quantity="1">
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
