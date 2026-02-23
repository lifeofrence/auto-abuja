<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

// Fetch categories for the dropdown
$categories_result = $conn->query("SELECT id, name FROM categories WHERE is_active = TRUE ORDER BY name");

// Handle Business Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_business'])) {
    $name = sanitize_input($_POST['business_name']);
    $category_id = (int) $_POST['category_id'];
    $address = sanitize_input($_POST['address']);
    $phone = sanitize_input($_POST['phone']);
    $email = sanitize_input($_POST['email']);
    $description = sanitize_input($_POST['description']);
    $slug = generate_slug($name) . '-' . rand(1000, 9999);

    // Handle image upload
    $cover_image = 'img/default-business.jpg';
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $uploaded_path = upload_image($_FILES['cover_image'], 'businesses');
        if ($uploaded_path) {
            $cover_image = $uploaded_path;
        }
    }

    $insert_query = "INSERT INTO businesses (user_id, category_id, business_name, slug, description, address, phone, email, cover_image, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iisssssss", $user_id, $category_id, $name, $slug, $description, $address, $phone, $email, $cover_image);

    if ($stmt->execute()) {
        set_flash_message("Business registered successfully! It is currently pending approval.", "success");
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Failed to register business. Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register My Business - A.R.T.P.S</title>
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
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-block"
                            style="background: url('img/carousel-bg-1.jpg') center/cover;">
                            <div
                                class="h-100 p-5 text-white d-flex flex-column justify-content-center bg-dark bg-opacity-75">
                                <h2 class="fw-bold mb-4">Reach More Customers in Abuja</h2>
                                <p><i class="fa fa-check-circle text-primary me-2"></i> Get verified by A.R.T.S.P</p>
                                <p><i class="fa fa-check-circle text-primary me-2"></i> Showcase your products</p>
                                <p><i class="fa fa-check-circle text-primary me-2"></i> Connect with vehicle owners</p>
                            </div>
                        </div>
                        <div class="col-md-7 bg-white p-5">
                            <h3 class="fw-bold mb-4">Register Your Business</h3>

                            <?php if ($error): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <form action="business-add.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="add_business" value="1">

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase">Business Name</label>
                                    <input type="text" name="business_name" class="form-control"
                                        placeholder="e.g. Abuja Car Specialists" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        <?php while ($cat = $categories_result->fetch_assoc()): ?>
                                            <option value="<?php echo $cat['id']; ?>">
                                                <?php echo htmlspecialchars($cat['name']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-uppercase">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control" placeholder="080 0000 0000"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-uppercase">Business Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="info@business.com">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase">Business Address</label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Full workshop/showroom address" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase">Description</label>
                                    <textarea name="description" class="form-control" rows="4"
                                        placeholder="Briefly describe your services..."></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-uppercase">Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Upload a photo of your workshop or showroom.</small>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm">
                                    Submit for Approval
                                </button>
                                <a href="dashboard.php" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">
                                    Cancel & Return
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>