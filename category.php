<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();
$categoryName = $_GET['name'] ?? '';

if (empty($categoryName)) {
    // Handle the case where category name is not provided
    // You can redirect to a default page or display an error message
    header('Location: index.php');
    exit;
}

$amountLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amountLocale, NumberFormatter::CURRENCY);

$productsInCategory = $products->getByCategory($categoryName);

if (empty($productsInCategory)) {
    // Handle the case where no products are found in the category
    // You can display a message or redirect to a different page
    echo '<p>No products found in this category.</p>';
} else {
?>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="text-center"><?php echo htmlspecialchars($categoryName); ?></h1>
        </div>
    </div>
    <div class="row">
        <h2>Products</h2>
        <?php foreach ($productsInCategory as $product) : ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($product['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?></h6>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Product</a>
                        <button class="btn btn-success add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php } ?>

<?php template('footer.php'); ?>