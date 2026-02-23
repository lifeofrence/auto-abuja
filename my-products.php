<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];

    // Safety check: ensure product belongs to user
    $check_query = "SELECT id FROM products WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $delete_id, $user_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $delete_query = "DELETE FROM products WHERE id = ?";
        $del_stmt = $conn->prepare($delete_query);
        $del_stmt->bind_param("i", $delete_id);
        if ($del_stmt->execute()) {
            set_flash_message("Product deleted successfully", "success");
        } else {
            set_flash_message("Error deleting product", "danger");
        }
    }
    header("Location: my-products.php");
    exit;
}

// Fetch user's products
$products_query = "SELECT p.*, b.business_name 
                  FROM products p 
                  JOIN businesses b ON p.business_id = b.id 
                  WHERE p.user_id = ? 
                  ORDER BY p.created_at DESC";
$stmt = $conn->prepare($products_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$products_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Products - A.R.T.S.P</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .page-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #06A3DA 100%);
            padding: 40px 0;
            color: white;
            margin-bottom: 40px;
        }

        .product-list-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .product-list-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-thumb {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="page-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-6 fw-bold mb-1">My Products & Services</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php" class="text-white">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">My Products</li>
                    </ol>
                </nav>
            </div>
            <a href="product-add.php" class="btn btn-warning fw-bold px-4" style="border-radius: 10px;">
                <i class="fa fa-plus me-2"></i>Add New Product
            </a>
        </div>
    </div>

    <div class="container pb-5">
        <?php
        $msg = get_flash_message();
        if ($msg):
            ?>
            <div class="alert alert-<?php echo $msg['type']; ?> alert-dismissible fade show mb-4" role="alert">
                <?php echo $msg['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <?php if ($products_result->num_rows > 0): ?>
                    <div class="table-responsive bg-white p-4 rounded shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Business</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($product = $products_result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo htmlspecialchars(($product['image'] ?? '') ?: 'img/default-product.jpg'); ?>"
                                                    class="product-thumb me-3">
                                                <div>
                                                    <h6 class="fw-bold mb-0">
                                                        <?php echo htmlspecialchars($product['name']); ?>
                                                    </h6>
                                                    <small class="text-muted">Added on
                                                        <?php echo format_date($product['created_at']); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-secondary small fw-bold">
                                                <?php echo htmlspecialchars($product['business_name']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-primary">₦
                                                <?php echo number_format($product['price'], 2); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($product['is_available']): ?>
                                                <span class="status-pill bg-success-light text-success border border-success">
                                                    <i class="fa fa-check-circle me-1"></i>Available
                                                </span>
                                            <?php else: ?>
                                                <span class="status-pill bg-danger-light text-danger border border-danger">
                                                    <i class="fa fa-times-circle me-1"></i>Unavailable
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu shadow border-0">
                                                    <li><a class="dropdown-item"
                                                            href="product-detail.php?slug=<?php echo $product['slug']; ?>"><i
                                                                class="fa fa-eye me-2"></i>View</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="product-edit.php?id=<?php echo $product['id']; ?>"><i
                                                                class="fa fa-edit me-2 text-info"></i>Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0)"
                                                            onclick="confirmDelete(<?php echo $product['id']; ?>)">
                                                            <i class="fa fa-trash me-2"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-light border p-5 text-center">
                        <div class="mb-3">
                            <i class="fa fa-box-open fa-3x text-muted"></i>
                        </div>
                        <h5 class="fw-bold">No Products Found</h5>
                        <p class="text-muted mb-4">You haven't listed any products or services yet. Start selling on
                            A.R.T.S.P today!</p>
                        <a href="product-add.php" class="btn btn-primary px-4 py-2 fw-bold">
                            Add Your First Product
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                window.location.href = 'my-products.php?delete_id=' + id;
            }
        }
    </script>
</body>

</html>