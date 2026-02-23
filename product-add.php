<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

// Fetch user's businesses for the dropdown
$businesses_query = "SELECT id, business_name FROM businesses WHERE user_id = ? AND status = 'approved'";
$stmt = $conn->prepare($businesses_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$businesses_result = $stmt->get_result();

// If no approved businesses, user can't add products
if ($businesses_result->num_rows === 0) {
    set_flash_message("You must have an approved business before you can list products.", "warning");
    header("Location: business-add.php");
    exit;
}

// Handle Product Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = sanitize_input($_POST['product_name']);
    $business_id = (int) $_POST['business_id'];
    $description = sanitize_input($_POST['description']);
    $price = (float) $_POST['price'];
    $slug = generate_slug($name) . '-' . rand(100, 999);

    // Handle image upload
    $image_path = 'img/default-product.jpg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploaded_path = upload_image($_FILES['image'], 'products');
        if ($uploaded_path) {
            $image_path = $uploaded_path;
        }
    }

    $insert_query = "INSERT INTO products (business_id, user_id, name, slug, description, price, image, is_available) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iisssds", $business_id, $user_id, $name, $slug, $description, $price, $image_path);

    if ($stmt->execute()) {
        set_flash_message("Product listed successfully!", "success");
        header("Location: my-products.php");
        exit;
    } else {
        $error = "Failed to list product. Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Product/Service - A.R.T.P.S</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'includes/header.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0">Add New Product or Service</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if ($error): ?>
                            <div class="alert alert-danger mb-4">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="product-add.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="add_product" value="1">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Associated Business</label>
                                <select name="business_id" class="form-select" required>
                                    <?php while ($bus = $businesses_result->fetch_assoc()): ?>
                                        <option value="<?php echo $bus['id']; ?>">
                                            <?php echo htmlspecialchars($bus['business_name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <small class="text-muted">Choose which of your businesses this product belongs
                                    to.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Product/Service Name</label>
                                <input type="text" name="product_name" class="form-control"
                                    placeholder="e.g. Toyo Tires, Engine Oil Change, etc." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Price (₦)</label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="5"
                                    placeholder="Detailed description of the product or service..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Product Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">A clear image helps customers find your product.</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 fw-bold">List Product</button>
                                <a href="my-products.php" class="btn btn-outline-dark">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>