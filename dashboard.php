<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];
$user = get_user_data($user_id);

// Fetch user's businesses
$businesses_query = "SELECT b.*, c.name as category_name 
                    FROM businesses b 
                    JOIN categories c ON b.category_id = c.id 
                    WHERE b.user_id = ? 
                    ORDER BY b.created_at DESC";
$stmt = $conn->prepare($businesses_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$businesses_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Dashboard - A.R.T.S.P</title>
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
        .dashboard-header {
            background: linear-gradient(135deg, #FFB400 0%, #F68B1E 100%);
            padding: 60px 0;
            color: #000;
        }

        .user-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .business-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .business-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-action {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- Dashboard Header -->
    <div class="container-fluid dashboard-header mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-2">Welcome Back,
                        <?php echo htmlspecialchars($user['name']); ?>!
                    </h1>
                    <p class="mb-0">Manage your profile, businesses, and services from your personal dashboard.</p>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <a href="logout.php" class="btn btn-dark px-4 py-2 fw-bold" style="border-radius: 10px;">
                        <i class="fa fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            <!-- User Info Sidebar -->
            <div class="col-lg-4">
                <div class="card user-card mb-4">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <img src="<?php echo $user['profile_image'] ?: 'img/testimonial-1.jpg'; ?>"
                                class="rounded-circle mb-3 border border-4 border-light shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <h4 class="fw-bold mb-1">
                                <?php echo htmlspecialchars($user['name']); ?>
                            </h4>
                            <span class="badge bg-primary px-3 py-2">
                                <?php echo ucfirst($user['role']); ?>
                            </span>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="text-muted small">Email Address</label>
                            <p class="fw-bold mb-0">
                                <?php echo htmlspecialchars($user['email']); ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small">Phone Number</label>
                            <p class="fw-bold mb-0">
                                <?php echo htmlspecialchars($user['phone']); ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small">Member Since</label>
                            <p class="fw-bold mb-0">
                                <?php echo format_date($user['created_at']); ?>
                            </p>
                        </div>
                        <a href="profile-edit.php" class="btn btn-outline-dark w-100 mt-2 btn-action">
                            <i class="fa fa-user-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-8">
                <!-- Businesses Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">My Businesses</h3>
                    <a href="business-add.php" class="btn btn-primary fw-bold px-4 btn-action">
                        <i class="fa fa-plus me-2"></i>Add Business
                    </a>
                </div>

                <div class="row g-4">
                    <?php if ($businesses_result->num_rows > 0): ?>
                        <?php while ($business = $businesses_result->fetch_assoc()): ?>
                            <div class="col-md-6">
                                <div class="card business-card h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="card-img-top"
                                        style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="fw-bold card-title mb-0">
                                                <?php echo htmlspecialchars($business['business_name']); ?>
                                            </h5>
                                            <?php
                                            $status_class = match ($business['status']) {
                                                'approved' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="status-badge <?php echo $status_class; ?>">
                                                <?php echo ucfirst($business['status']); ?>
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-3">
                                            <i class="fa fa-tag me-2"></i>
                                            <?php echo htmlspecialchars($business['category_name']); ?>
                                        </p>
                                        <p class="text-muted small mb-4">
                                            <i class="fa fa-map-marker-alt me-2"></i>
                                            <?php echo htmlspecialchars($business['address']); ?>
                                        </p>
                                        <div class="d-flex gap-2">
                                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>"
                                                class="btn btn-outline-dark btn-sm flex-grow-1">
                                                View Page
                                            </a>
                                            <a href="business-edit.php?id=<?php echo $business['id']; ?>"
                                                class="btn btn-dark btn-sm flex-grow-1">
                                                Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-light border p-5 text-center">
                                <div class="mb-3">
                                    <i class="fa fa-building fa-3x text-muted"></i>
                                </div>
                                <h5 class="fw-bold">No Businesses Found</h5>
                                <p class="text-muted mb-4">You haven't registered any business yet. Start reaching more
                                    customers in Abuja today!</p>
                                <a href="business-add.php" class="btn btn-primary px-4 py-2 fw-bold btn-action">
                                    Register Your Business
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Recent Activities Section -->
                <h3 class="fw-bold mb-4 mt-5">Account Actions</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card business-card">
                            <div class="card-body p-4 text-center">
                                <i class="fa fa-box fa-2x mb-3 text-primary"></i>
                                <h5 class="fw-bold">My Products</h5>
                                <p class="small text-muted">Manage your listed products and services.</p>
                                <a href="my-products.php" class="btn btn-outline-primary btn-sm w-100">View Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card business-card">
                            <div class="card-body p-4 text-center">
                                <i class="fa fa-star fa-2x mb-3 text-warning"></i>
                                <h5 class="fw-bold">My Reviews</h5>
                                <p class="small text-muted">See what customers are saying about you.</p>
                                <a href="my-reviews.php" class="btn btn-outline-warning btn-sm w-100">View Reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>