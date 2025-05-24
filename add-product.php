<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Category;
use Aries\MiniFrameworkStore\Models\Product;
use Carbon\Carbon;

$categories = new Category();
$product = new Product();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image'];

    // Validate and process the image file
    if ($image['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $targetFile);
    }

    // Insert the product into the database
    $product->insert([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'slug' => strtolower(str_replace(' ', '-', $name)),
        'image_path' => $targetFile,
        'category_id' => $category,
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now()
    ]);

    $message = "Product added successfully!";
}
?>

<!-- Bootstrap Icons CDN (needed for the icon on the button) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Product Page Wrapper -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">🛒 Add a New Product</h2>
                            <p class="text-muted">Provide the details below to list your product.</p>
                        </div>

                        <?php if (isset($message)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="add-product.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="productName" class="form-label fw-semibold">Product Name</label>
                                <input type="text" class="form-control form-control-lg rounded-3" id="productName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label fw-semibold">Description</label>
                                <textarea class="form-control form-control-lg rounded-3" id="productDescription" name="description" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label fw-semibold">Price (₱)</label>
                                <input type="number" step="0.01" class="form-control form-control-lg rounded-3" id="productPrice" name="price" required>
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label fw-semibold">Category</label>
                                <select class="form-select form-select-lg rounded-3" id="productCategory" name="category" required>
                                    <option value="" disabled selected>Choose a category</option>
                                    <?php foreach ($categories->getAll() as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="productImage" class="form-label fw-semibold">Product Image</label>
                                <input class="form-control form-control-lg rounded-3" type="file" id="productImage" name="image" accept="image/*">
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i>Add Product
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
