<?php
require_once 'includes/config.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header("Location: index.php");
    exit;
}

// Fetch business details
$query = "SELECT b.*, c.name as category_name 
          FROM businesses b 
          JOIN categories c ON b.category_id = c.id 
          WHERE b.slug = ? AND b.status = 'approved'";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: 404.php");
    exit;
}

$business = $result->fetch_assoc();

// Update views count
$conn->query("UPDATE businesses SET views_count = views_count + 1 WHERE id = " . $business['id']);

// Fetch business gallery images
$gallery_query = "SELECT image_path, caption FROM business_images WHERE business_id = ? ORDER BY display_order";
$gallery_stmt = $conn->prepare($gallery_query);
$gallery_stmt->bind_param("i", $business['id']);
$gallery_stmt->execute();
$gallery_result = $gallery_stmt->get_result();
$gallery = [];
while ($img = $gallery_result->fetch_assoc()) {
    $gallery[] = $img;
}

// Fetch products from this business
$products_query = "SELECT * FROM products WHERE business_id = ? AND is_available = TRUE";
$products_stmt = $conn->prepare($products_query);
$products_stmt->bind_param("i", $business['id']);
$products_stmt->execute();
$products_result = $products_stmt->get_result();

$business_hours = json_decode($business['business_hours'] ?? '{}', true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php echo htmlspecialchars($business['business_name']); ?> - Auto Abuja
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo htmlspecialchars($business['business_name']); ?>, auto abuja, mechanics" name="keywords">
    <meta content="<?php echo htmlspecialchars(substr($business['description'], 0, 160)); ?>" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .business-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?php echo $business['cover_image'] ?: 'img/carousel-bg-1.jpg'; ?>');
            background-position: center;
            background-size: cover;
            padding: 100px 0;
            color: white;
            border-radius: 0 0 50px 50px;
        }

        .business-logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            background: white;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: -75px;
        }

        .contact-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .gallery-img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        .nav-pills .nav-link {
            color: #444;
            border-radius: 50px;
            padding: 10px 25px;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active {
            background-color: #F68B1E;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- Business Header -->
    <div class="business-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-white mb-3">
                <?php echo htmlspecialchars($business['business_name']); ?>
            </h1>
            <div class="d-flex justify-content-center align-items-center">
                <span class="badge bg-primary px-3 py-2 me-3">
                    <?php echo htmlspecialchars($business['category_name']); ?>
                </span>
                <?php if ($business['verified']): ?>
                    <span class="text-success"><i class="fa fa-check-circle me-1"></i>Verified Business</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="text-center">
            <img src="<?php echo $business['logo'] ?: 'img/default-logo.png'; ?>" class="business-logo" alt="Logo">
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-about-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-about" type="button" role="tab">About</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-products-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-products" type="button" role="tab">Products & Services</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-gallery" type="button" role="tab">Gallery</button>
                    </li>
                </ul>

                <div class="tab-content border-top pt-4" id="pills-tabContent">
                    <!-- About Tab -->
                    <div class="tab-pane fade show active" id="pills-about" role="tabpanel">
                        <h4 class="fw-bold mb-4">Description</h4>
                        <p class="fs-5 mb-5">
                            <?php echo nl2br(htmlspecialchars($business['description'])); ?>
                        </p>

                        <h4 class="fw-bold mb-4">Location</h4>
                        <p class="mb-4"><i class="fa fa-map-marker-alt text-primary me-2"></i>
                            <?php echo htmlspecialchars($business['address']); ?>
                        </p>
                        <!-- Map placeholder -->
                        <div class="bg-light rounded p-4 text-center"
                            style="height: 300px; display: flex; align-items: center; justify-content: center; background-image: url('img/map-placeholder.jpg'); background-size: cover;">
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($business['address']); ?>"
                                target="_blank" class="btn btn-dark">Open in Google Maps</a>
                        </div>
                    </div>

                    <!-- Products Tab -->
                    <div class="tab-pane fade" id="pills-products" role="tabpanel">
                        <div class="row g-4">
                            <?php if ($products_result->num_rows > 0): ?>
                                <?php while ($product = $products_result->fetch_assoc()): ?>
                                    <div class="col-md-6">
                                        <div class="card h-100 border shadow-sm">
                                            <img src="<?php echo $product['image'] ?: 'img/default-product.jpg'; ?>"
                                                class="card-img-top" style="height: 200px; object-fit: cover;"
                                                alt="<?php echo htmlspecialchars($product['name']); ?>">
                                            <div class="card-body">
                                                <h5 class="fw-bold">
                                                    <?php echo htmlspecialchars($product['name']); ?>
                                                </h5>
                                                <p class="text-primary fw-bold fs-5">₦
                                                    <?php echo number_format($product['price'], 2); ?>
                                                </p>
                                                <a href="product-detail.php?slug=<?php echo $product['slug']; ?>"
                                                    class="btn btn-outline-primary btn-sm w-100">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <p class="text-muted">No products or services listed yet.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Gallery Tab -->
                    <div class="tab-pane fade" id="pills-gallery" role="tabpanel">
                        <div class="row g-3">
                            <?php if (!empty($gallery)): ?>
                                <?php foreach ($gallery as $img): ?>
                                    <div class="col-md-4">
                                        <img src="<?php echo $img['image_path']; ?>" class="img-fluid gallery-img"
                                            alt="<?php echo htmlspecialchars($img['caption'] ?? ''); ?>" data-bs-toggle="modal"
                                            data-bs-target="#galleryModal" onclick="setModalImg(this.src)">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <p class="text-muted">No images in gallery yet.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="contact-card p-4">
                    <h4 class="fw-bold mb-4">Contact Details</h4>
                    <div class="mb-4">
                        <div class="d-flex mb-3">
                            <div class="btn-square bg-light rounded-circle me-3">
                                <i class="fa fa-phone-alt text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Phone Number</h6>
                                <p class="mb-0">
                                    <?php echo htmlspecialchars($business['phone']); ?>
                                </p>
                            </div>
                        </div>
                        <?php if ($business['email']): ?>
                            <div class="d-flex mb-3">
                                <div class="btn-square bg-light rounded-circle me-3">
                                    <i class="fa fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email Address</h6>
                                    <p class="mb-0">
                                        <?php echo htmlspecialchars($business['email']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($business['whatsapp']): ?>
                            <div class="d-flex mb-3">
                                <div class="btn-square bg-light rounded-circle me-3">
                                    <i class="fab fa-whatsapp text-primary text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">WhatsApp</h6>
                                    <p class="mb-0">
                                        <?php echo htmlspecialchars($business['whatsapp']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <a href="tel:<?php echo $business['phone']; ?>" class="btn btn-primary py-3">Call Now</a>
                        <?php if ($business['whatsapp']): ?>
                            <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', $business['whatsapp']); ?>"
                                class="btn btn-success py-3">WhatsApp Message</a>
                        <?php endif; ?>
                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3 mt-4">Opening Hours</h5>
                    <ul class="list-unstyled">
                        <?php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        foreach ($days as $day):
                            $hours = $business_hours[strtolower($day)] ?? 'Closed';
                            ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span>
                                    <?php echo $day; ?>
                                </span>
                                <span class="text-muted">
                                    <?php echo $hours; ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bg-dark text-white rounded p-4 mt-4">
                    <h5 class="text-white mb-3">Verify this business</h5>
                    <p class="small mb-0">Our team ensures that all listed businesses are genuine. If you encounter any
                        issues, please <a href="contact.php" class="text-primary">report it</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <img src="" id="modalImg" class="img-fluid w-100 rounded">
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setModalImg(src) {
            document.getElementById('modalImg').src = src;
        }
    </script>
</body>

</html>