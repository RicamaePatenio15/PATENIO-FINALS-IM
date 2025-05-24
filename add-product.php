<?php 
session_start();
include 'helpers/functions.php'; 
?>
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

<style>
    .product-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-form .form-label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-form .form-control {
        border-radius: 5px;
        padding: 10px;
    }

    .product-form .btn-primary {
        background-color: #ee4d2d;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        border-radius: 5px;
    }

    .product-form .btn-primary:hover {
        background-color: #c3231f;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="product-form">
                <h2 class="fw-bold mb-4">Add a New Product</h2>

                <?php if (isset($message)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="add-product.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price (₱)</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category" required>
                            <option value="" disabled selected>Choose a category</option>
                            <?php foreach ($categories->getAll() as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="productImage" name="image" accept="image/*">
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>