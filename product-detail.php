<?php
require_once 'includes/config.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header("Location: index.php");
    exit;
}

// Fetch product details with business info
$query = "SELECT p.*, b.business_name, b.slug as business_slug, b.phone as business_phone, b.address as business_address, b.verified as business_verified 
          FROM products p 
          JOIN businesses b ON p.business_id = b.id 
          WHERE p.slug = ? AND p.is_available = TRUE";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: 404.php");
    exit;
}

$product = $result->fetch_assoc();

// Update views count
$conn->query("UPDATE products SET views_count = views_count + 1 WHERE id = " . $product['id']);

// Fetch more images for the product
$images_query = "SELECT image_path FROM product_images WHERE product_id = ? ORDER BY display_order";
$images_stmt = $conn->prepare($images_query);
$images_stmt->bind_param("i", $product['id']);
$images_stmt->execute();
$images_result = $images_stmt->get_result();
$product_images = [];
while ($img = $images_result->fetch_assoc()) {
    $product_images[] = $img['image_path'];
}

// Fetch related products from the same business
$related_query = "SELECT * FROM products WHERE business_id = ? AND id != ? LIMIT 4";
$related_stmt = $conn->prepare($related_query);
$related_stmt->bind_param("ii", $product['business_id'], $product['id']);
$related_stmt->execute();
$related_result = $related_stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php echo htmlspecialchars($product['name']); ?> - Auto Abuja
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo htmlspecialchars($product['name']); ?>" name="keywords">
    <meta content="<?php echo htmlspecialchars(substr($product['description'], 0, 160)); ?>" name="description">

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
        .product-image-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .thumb-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 8px;
            margin-right: 10px;
            border: 2px solid transparent;
            transition: 0.3s;
        }

        .thumb-image:hover,
        .thumb-image.active {
            border-color: #F68B1E;
        }

        .business-card {
            border: none;
            border-radius: 15px;
            background: #f8f9fa;
            padding: 25px;
        }

        .price-tag {
            font-size: 2rem;
            color: #F68B1E;
            font-weight: 700;
        }

        .badge-verified {
            background-color: #198754;
            color: white;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-xxl py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </li>
                </ol>
            </nav>

            <div class="row g-5">
                <!-- Product Images -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-image-container mb-3">
                        <img id="mainImage" src="<?php echo $product['image'] ?: 'img/default-product.jpg'; ?>"
                            class="main-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <?php if (!empty($product_images)): ?>
                        <div class="d-flex overflow-auto pb-2">
                            <img src="<?php echo $product['image'] ?: 'img/default-product.jpg'; ?>"
                                class="thumb-image active" onclick="changeImage(this.src, this)">
                            <?php foreach ($product_images as $img): ?>
                                <img src="<?php echo $img; ?>" class="thumb-image" onclick="changeImage(this.src, this)">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-5 fw-bold mb-3">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h1>

                    <div class="d-flex align-items-center mb-4">
                        <span class="price-tag me-3">₦
                            <?php echo number_format($product['price'], 2); ?>
                        </span>
                        <?php if ($product['price_type'] !== 'fixed'): ?>
                            <span class="badge bg-light text-dark border">
                                <?php echo ucfirst($product['price_type']); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted"><i class="fa fa-eye me-2"></i>
                            <?php echo number_format($product['views_count']); ?> views
                        </p>
                    </div>

                    <p class="fs-5 mb-5">
                        <?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?>
                    </p>

                    <div class="business-card mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="mb-0 me-2">Sold by: <a
                                    href="business-detail.php?slug=<?php echo $product['business_slug']; ?>"
                                    class="text-primary">
                                    <?php echo htmlspecialchars($product['business_name']); ?>
                                </a></h5>
                            <?php if ($product['business_verified']): ?>
                                <span class="badge-verified"><i class="fa fa-check-circle me-1"></i>Verified</span>
                            <?php endif; ?>
                        </div>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>
                            <?php echo htmlspecialchars($product['business_address']); ?>
                        </p>
                        <p class="mb-4"><i class="fa fa-phone-alt text-primary me-2"></i>
                            <?php echo htmlspecialchars($product['business_phone']); ?>
                        </p>

                        <div class="row g-2">
                            <div class="col-6">
                                <a href="tel:<?php echo $product['business_phone']; ?>"
                                    class="btn btn-primary w-100 py-3">
                                    <i class="fa fa-phone-alt me-2"></i>Call Now
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', $product['business_phone']); ?>"
                                    class="btn btn-success w-100 py-3">
                                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- <button class="btn btn-outline-dark w-100 py-3 add-to-cart"
                        data-product="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>">
                        <i class="fa fa-shopping-cart me-2"></i>Add to Cart
                    </button> -->
                </div>
            </div>

            <!-- Related Products -->
            <?php if ($related_result->num_rows > 0): ?>
                <div class="mt-5 pt-5">
                    <h3 class="fw-bold mb-4">Other products from this business</h3>
                    <div class="row g-4">
                        <?php while ($rp = $related_result->fetch_assoc()): ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                                    <img src="<?php echo $rp['image'] ?: 'img/default-product.jpg'; ?>" class="card-img-top"
                                        style="height: 180px; object-fit: cover;"
                                        alt="<?php echo htmlspecialchars($rp['name']); ?>">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-2">
                                            <?php echo htmlspecialchars($rp['name']); ?>
                                        </h6>
                                        <p class="text-primary fw-bold mb-3">₦
                                            <?php echo number_format($rp['price'], 2); ?>
                                        </p>
                                        <a href="product-detail.php?slug=<?php echo $rp['slug']; ?>"
                                            class="btn btn-sm btn-outline-primary w-100">View Product</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        function changeImage(src, thumb) {
            document.getElementById('mainImage').src = src;
            const thumbs = document.querySelectorAll('.thumb-image');
            thumbs.forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }
    </script>
</body>

</html>