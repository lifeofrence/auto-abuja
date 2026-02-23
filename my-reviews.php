<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];

// Fetch reviews for the user's businesses
$reviews_query = "SELECT r.*, b.business_name, u.name as reviewer_name 
                 FROM reviews r 
                 JOIN businesses b ON r.business_id = b.id 
                 JOIN users u ON r.user_id = u.id 
                 WHERE b.user_id = ? 
                 ORDER BY r.created_at DESC";
$stmt = $conn->prepare($reviews_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$reviews_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Customer Reviews - A.R.T.S.P</title>
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
</head>

<body class="bg-light">
    <?php include 'includes/header.php'; ?>

    <div class="bg-dark py-5 mb-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-4 text-white fw-bold mb-3">Customer Reviews</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-white-50">Dashboard</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Reviews</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            <?php if ($reviews_result->num_rows > 0): ?>
                <?php while ($review = $reviews_result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-3">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px; font-weight: bold;">
                                            <?php echo strtoupper(substr($review['reviewer_name'], 0, 1)); ?>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-0">
                                            <?php echo htmlspecialchars($review['reviewer_name']); ?>
                                        </h6>
                                        <small class="text-muted">
                                            <?php echo format_date($review['created_at']); ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-warning mb-1">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="badge bg-light text-dark small border">
                                        On:
                                        <?php echo htmlspecialchars($review['business_name']); ?>
                                    </span>
                                </div>
                                <p class="card-text text-secondary font-italic">"
                                    <?php echo htmlspecialchars($review['comment']); ?>"
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-3 shadow-sm border">
                        <i class="fa fa-comment-dots fa-4x text-muted mb-4"></i>
                        <h4 class="fw-bold">No Reviews Yet</h4>
                        <p class="text-muted">Once customers start reviewing your business, they'll appear right here!</p>
                        <a href="dashboard.php" class="btn btn-primary mt-3 px-4 fw-bold">Return to Dashboard</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>