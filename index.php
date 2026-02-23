<?php
require_once 'includes/config.php';

// Fetch categories for the search bar
$search_categories_query = "SELECT name, slug FROM categories WHERE is_active = TRUE ORDER BY display_order";
$search_categories_result = $conn->query($search_categories_query);

// Search Results Logic
$show_results = false;
$search_business_results = null;
$search_product_results = null;

if (isset($_GET['search']) || isset($_GET['category'])) {
    $show_results = true;
    $search = isset($_GET['search']) ? sanitize_input($_GET['search']) : '';
    $category_slug = isset($_GET['category']) ? sanitize_input($_GET['category']) : '';

    // 1. Search Businesses
    $where_clauses = ["b.status = 'approved'"];
    if ($category_slug) {
        $where_clauses[] = "c.slug = '$category_slug'";
    }
    if ($search) {
        $where_clauses[] = "(b.business_name LIKE '%$search%' OR b.description LIKE '%$search%' OR b.address LIKE '%$search%' 
                            OR b.id IN (SELECT business_id FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'))";
    }

    $where_sql = implode(' AND ', $where_clauses);

    $query_b = "SELECT b.*, c.name as category_name, c.slug as category_slug, 
              sc.name as subcategory_name, sc.slug as subcategory_slug, sc.badge_color
              FROM businesses b
              LEFT JOIN categories c ON b.category_id = c.id
              LEFT JOIN subcategories sc ON b.subcategory_id = sc.id
              WHERE $where_sql
              ORDER BY b.is_featured DESC, b.created_at DESC
              LIMIT 12";

    $search_business_results = $conn->query($query_b);

    // 2. Search Products
    $p_where = ["p.is_available = TRUE"];
    if ($search) {
        $p_where[] = "(p.name LIKE '%$search%' OR p.description LIKE '%$search%')";
    }
    if ($category_slug) {
        $p_where[] = "c.slug = '$category_slug'";
    }
    $p_where_sql = implode(' AND ', $p_where);

    $query_p = "SELECT p.*, b.business_name, b.slug as business_slug, c.name as category_name
                FROM products p
                JOIN businesses b ON p.business_id = b.id
                JOIN categories c ON b.category_id = c.id
                WHERE $p_where_sql
                ORDER BY p.created_at DESC
                LIMIT 12";
    $search_product_results = $conn->query($query_p);
}

// Fetch Featured Products for the grid
$featured_products_query = "SELECT p.*, b.business_name, b.slug as business_slug 
                           FROM products p 
                           JOIN businesses b ON p.business_id = b.id 
                           WHERE p.is_available = TRUE 
                           ORDER BY p.is_featured DESC, p.created_at DESC 
                           LIMIT 8";
$featured_products_result = $conn->query($featured_products_query);
// Fetch Carousel Advertisements (homepage_top)
$carousel_ads_query = "SELECT * FROM advertisements WHERE position = 'homepage_top' AND is_active = TRUE ORDER BY display_order";
$carousel_ads_result = $conn->query($carousel_ads_query);

// Fetch Promo Advertisements (homepage_middle)
$promo_ads_query = "SELECT * FROM advertisements WHERE position = 'homepage_middle' AND is_active = TRUE ORDER BY display_order LIMIT 3";
$promo_ads_result = $conn->query($promo_ads_query);

// Fetch Leading Businesses by Primary Categories
function get_businesses_by_category($conn, $category_slug, $limit = 4)
{
    $sql = "SELECT b.*, c.name as category_name, c.slug as category_slug 
            FROM businesses b 
            JOIN categories c ON b.category_id = c.id 
            WHERE c.slug = '$category_slug' AND b.status = 'approved' 
            ORDER BY b.is_featured DESC, b.created_at DESC 
            LIMIT $limit";
    return $conn->query($sql);
}

$mechanics_result = get_businesses_by_category($conn, 'mechanics', 8);
$dealers_result = get_businesses_by_category($conn, 'dealers', 8);
$spare_parts_result = get_businesses_by_category($conn, 'spare-parts', 8);
$towing_result = get_businesses_by_category($conn, 'towing', 8);
$recyclers_result = get_businesses_by_category($conn, 'recyclers', 8);

// Fetch Partners
$partners_result = $conn->query("SELECT * FROM partners ORDER BY display_order");

// Fetch Testimonials
$testimonials_result = $conn->query("SELECT * FROM testimonials ORDER BY created_at DESC");

// Fetch All Categories for the Grid
$all_categories_query = "SELECT * FROM categories WHERE is_active = TRUE ORDER BY display_order";
$all_categories_result = $conn->query($all_categories_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A.R.T.S.P - Automotive Resource & Technical Service Platform</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>


    <!-- Hero Section Start -->
    <div class="container-fluid" style="background: #FFB400; padding: 80px 0 60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-4 text-black mb-3 fw-bold">Find Trusted Automotive Services in Abuja</h1>
                    <p class="text-black-50 mb-4 fs-5">Connect with verified mechanics, dealers, and auto service
                        providers</p>

                    <!-- Search Bar -->
                    <div class="search-container bg-white rounded-3 p-2 shadow-lg">
                        <form action="index.php" method="GET" class="row g-2 align-items-center">
                            <div class="col-md-5">
                                <input type="text" name="search" class="form-control border-0 py-3"
                                    placeholder="What are you looking for?" style="font-size: 16px;">
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-select border-0 py-3" style="font-size: 16px;">
                                    <option value="">All Categories</option>
                                    <?php if ($search_categories_result && $search_categories_result->num_rows > 0): ?>
                                        <?php while ($cat = $search_categories_result->fetch_assoc()): ?>
                                            <option value="<?php echo htmlspecialchars($cat['slug']); ?>">
                                                <?php echo htmlspecialchars($cat['name']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <option value="mechanics">Auto Mechanics & Technicians</option>
                                        <option value="dealers">Automobile Dealerships</option>
                                        <option value="spare-parts">Auto Spare Parts</option>
                                        <option value="towing">Tow Truck Operators</option>
                                        <option value="recyclers">Auto Dismantlers & Recyclers</option>
                                        <option value="service-stations">Service Stations</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn w-100 py-3 fw-bold"
                                    style="background: #F68B1E; border: none; color: #000;">
                                    <i class="fa fa-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- <div class="row mb-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="col-lg-12">
                            <div class="bg-light p-4 rounded">
                                <div class="row g-3 align-items-center">
                                  
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="productSearch"
                                                placeholder="Search for products (e.g., Benz, Camry, EV)...">
                                            <button class="btn w-100" type="button"
                                                style="background: #F68B1E; border: none; color: #000; max-width: 120px;">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>

                                  
                                    <div class="col-lg-4">
                                        <select class="form-select" id="categoryFilter">
                                            <option value="mechanics">Auto Mechanics & Technicians</option>
                                            <option value="dealers">Automobile Dealerships</option>
                                            <option value="spare-parts">Auto Spare Parts</option>
                                            <option value="towing">Tow Truck Operators</option>
                                            <option value="recyclers">Auto Dismantlers & Recyclers</option>
                                            <option value="service-stations">Service Stations</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <?php if ($show_results): ?>
        <!-- Search Results Section Start -->
        <div class="container-xxl py-5" id="searchResults">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="mb-3 fw-bold">Search Results</h2>
                    <p class="text-muted">Explore businesses and products matching your criteria</p>
                    <a href="index.php" class="btn btn-link text-primary p-0">Clear Search</a>
                </div>

                <!-- Product Results -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-4"><i class="fa fa-box me-2 text-primary"></i>Products & Services
                        (<?php echo $search_product_results ? $search_product_results->num_rows : 0; ?>)</h4>
                    <div class="row g-4">
                        <?php if ($search_product_results && $search_product_results->num_rows > 0): ?>
                            <?php while ($product = $search_product_results->fetch_assoc()): ?>
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="card h-100 border-0 shadow-sm hover-lift"
                                        style="border-radius: 12px; overflow: hidden;">
                                        <div class="position-relative">
                                            <img src="<?php echo $product['image'] ?: 'img/default-product.jpg'; ?>"
                                                class="card-img-top" style="height: 160px; object-fit: cover;"
                                                alt="<?php echo htmlspecialchars($product['name'] ?? ''); ?>">
                                            <div class="position-absolute bottom-0 end-0 p-2">
                                                <span
                                                    class="badge bg-primary px-2 py-1 shadow-sm">₦<?php echo number_format($product['price'], 2); ?></span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-dark text-truncate">
                                                <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                                            </h6>
                                            <p class="text-muted small mb-2">By: <a
                                                    href="business-detail.php?slug=<?php echo $product['business_slug']; ?>"
                                                    class="text-primary fw-bold"><?php echo htmlspecialchars($product['business_name'] ?? ''); ?></a>
                                            </p>
                                            <p class="text-muted small mb-3">
                                                <?php echo substr(htmlspecialchars($product['description'] ?? ''), 0, 60); ?>...
                                            </p>
                                            <a href="product-detail.php?slug=<?php echo $product['slug']; ?>"
                                                class="btn btn-dark btn-sm w-100" style="border-radius: 6px;">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-light border text-center text-muted">No matching products or services
                                    found.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Business Results -->
                <div>
                    <h4 class="fw-bold mb-4"><i class="fa fa-building me-2 text-primary"></i>Businesses
                        (<?php echo $search_business_results ? $search_business_results->num_rows : 0; ?>)</h4>
                    <div class="row g-4">
                        <?php if ($search_business_results && $search_business_results->num_rows > 0): ?>
                            <?php while ($business = $search_business_results->fetch_assoc()): ?>
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="card h-100 border-0 shadow-sm hover-lift"
                                        style="border-radius: 12px; overflow: hidden;">
                                        <div class="position-relative">
                                            <img src="<?php echo $business['cover_image'] ?: 'img/default-business.jpg'; ?>"
                                                class="card-img-top" style="height: 180px; object-fit: cover;"
                                                alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>">
                                            <?php if ($business['is_featured']): ?>
                                                <div class="position-absolute top-0 end-0 p-2">
                                                    <span class="badge bg-warning text-dark shadow-sm"><i
                                                            class="fa fa-star me-1"></i>Featured</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($business['verified']): ?>
                                                <div class="position-absolute top-0 start-0 p-2">
                                                    <span class="badge bg-success shadow-sm"><i
                                                            class="fa fa-check-circle me-1"></i>Verified</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-1 text-dark text-truncate">
                                                <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                            </h5>
                                            <span
                                                class="badge bg-light text-primary mb-2"><?php echo htmlspecialchars($business['category_name'] ?? ''); ?></span>
                                            <p class="text-muted small mb-3">
                                                <?php echo substr(htmlspecialchars($business['description'] ?? ''), 0, 80); ?>...
                                            </p>
                                            <div class="mb-3">
                                                <div class="text-muted small mb-1"><i
                                                        class="fa fa-map-marker-alt me-2 text-primary"></i><?php echo htmlspecialchars($business['address'] ?? ''); ?>
                                                </div>
                                                <div class="text-muted small"><i
                                                        class="fa fa-phone me-2 text-primary"></i><?php echo htmlspecialchars($business['phone'] ?? ''); ?>
                                                </div>
                                            </div>
                                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>"
                                                class="btn btn-outline-dark btn-sm w-100" style="border-radius: 6px;">View
                                                Business</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-light border text-center text-muted">No matching businesses found.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <hr class="mt-5">
            </div>
        </div>
        <!-- Search Results Section End -->
    <?php endif; ?>



    <!-- Featured Products Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5">
                <!-- <h6 class="text-uppercase mb-2" style="color: #F68B1E; font-weight: 600; letter-spacing: 2px;">Featured  Products</h6> -->
                <!-- <h2 class="mb-3 fw-bold">Available Products & Services</h2> -->
                <!-- <p class="text-muted">Browse our selection of vehicles, parts, and services</p> -->
            </div>

            <!-- Search and Cart Section -->


            <!-- Products Grid -->
            <div class="row g-4" id="productsGrid">
                <?php if ($featured_products_result && $featured_products_result->num_rows > 0): ?>
                    <?php
                    $delay = 0.1;
                    while ($product = $featured_products_result->fetch_assoc()):
                        ?>
                        <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="<?php echo $delay; ?>s">
                            <div class="card h-100 border-0 shadow">
                                <div class="position-relative">
                                    <img src="<?php echo htmlspecialchars(($product['image'] ?? '') ?: 'img/default-product.jpg'); ?>"
                                        class="card-img-top" alt="<?php echo htmlspecialchars($product['name'] ?? ''); ?>"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-3">
                                        <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                                    </h5>
                                    <h4 class="mb-3" style="color: #F68B1E;">₦
                                        <?php echo number_format($product['price'], 2); ?>
                                    </h4>
                                    <p class="text-muted mb-2">
                                        <i class="fa fa-check-circle text-success"></i>
                                        Available:
                                        <?php echo $product['is_available'] ? 'Yes' : 'No'; ?>
                                    </p>
                                    <p class="text-secondary mb-3 small">By:
                                        <?php echo htmlspecialchars($product['business_name'] ?? ''); ?>
                                    </p>
                                    <a href="product-detail.php?slug=<?php echo $product['slug']; ?>"
                                        class="btn btn-outline-dark w-100 btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $delay += 0.2;
                    endwhile;
                    ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No featured products available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>


            <!-- No Results Message -->
            <div class="row mt-4 d-none" id="noResults">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i>
                        No products found matching your search criteria. Try different keywords or filters.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Products End -->

    <!-- Category Listings Sections Start -->

    <!-- 1. Auto Mechanics & Technicians -->
    <div class="container-xxl py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div>
                    <h3 class="fw-bold mb-0">Auto Mechanics & Technicians</h3>
                    <p class="text-muted small mb-0">Expert vehicle repair and maintenance services in Abuja</p>
                </div>
                <a href="listings.php?category=mechanics" class="btn btn-sm fw-bold px-3 py-2"
                    style="background: #F68B1E; color: #000; border: none;">
                    See All <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                <?php if ($mechanics_result && $mechanics_result->num_rows > 0): ?>
                    <?php while ($business = $mechanics_result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" class="text-decoration-none">
                                <div class="bg-white p-2 rounded shadow-sm hover-lift text-center h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="img-fluid rounded mb-3"
                                        alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>"
                                        style="height: 180px; width: 100%; object-fit: cover;">
                                    <h5 class="fw-bold text-dark px-2">
                                        <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                    </h5>
                                    <?php if ($business['verified']): ?>
                                        <div class="mt-2">
                                            <span class="badge bg-success small"><i
                                                    class="fa fa-check-circle me-1"></i>Verified</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 2. Automobile Dealerships -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div>
                    <h3 class="fw-bold mb-0">Automobile Dealerships</h3>
                    <p class="text-muted small mb-0">Certified car dealers and showrooms in Abuja</p>
                </div>
                <a href="listings.php?category=dealers" class="btn btn-sm fw-bold px-3 py-2"
                    style="background: #F68B1E; color: #000; border: none;">
                    See All <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                <?php if ($dealers_result && $dealers_result->num_rows > 0): ?>
                    <?php while ($business = $dealers_result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" class="text-decoration-none">
                                <div class="bg-white p-2 rounded shadow-sm hover-lift text-center h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="img-fluid rounded mb-3"
                                        alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>"
                                        style="height: 180px; width: 100%; object-fit: cover;">
                                    <h5 class="fw-bold text-dark px-2">
                                        <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                    </h5>
                                    <?php if ($business['verified']): ?>
                                        <div class="mt-2">
                                            <span class="badge bg-success small"><i
                                                    class="fa fa-check-circle me-1"></i>Verified</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No dealers listed yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 3. Auto Spare Parts -->
    <div class="container-xxl py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div>
                    <h3 class="fw-bold mb-0">Auto Spare Parts</h3>
                    <p class="text-muted small mb-0">Genuine spare parts for all vehicle makes and models</p>
                </div>
                <a href="listings.php?category=spare-parts" class="btn btn-sm fw-bold px-3 py-2"
                    style="background: #F68B1E; color: #000; border: none;">
                    See All <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                <?php if ($spare_parts_result && $spare_parts_result->num_rows > 0): ?>
                    <?php while ($business = $spare_parts_result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" class="text-decoration-none">
                                <div class="bg-white p-2 rounded shadow-sm hover-lift text-center h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="img-fluid rounded mb-3"
                                        alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>"
                                        style="height: 180px; width: 100%; object-fit: cover;">
                                    <h5 class="fw-bold text-dark px-2">
                                        <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                    </h5>
                                    <?php if ($business['verified']): ?>
                                        <div class="mt-2">
                                            <span class="badge bg-success small"><i
                                                    class="fa fa-check-circle me-1"></i>Verified</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No spare part shops listed yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 4. Tow Truck Operators -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div>
                    <h3 class="fw-bold mb-0">Tow Truck Operators</h3>
                    <p class="text-muted small mb-0">Reliable towing and recovery services in Abuja</p>
                </div>
                <a href="listings.php?category=towing" class="btn btn-sm fw-bold px-3 py-2"
                    style="background: #F68B1E; color: #000; border: none;">
                    See All <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                <?php if ($towing_result && $towing_result->num_rows > 0): ?>
                    <?php while ($business = $towing_result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" class="text-decoration-none">
                                <div class="bg-white p-2 rounded shadow-sm hover-lift text-center h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="img-fluid rounded mb-3"
                                        alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>"
                                        style="height: 180px; width: 100%; object-fit: cover;">
                                    <h5 class="fw-bold text-dark px-2">
                                        <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                    </h5>
                                    <?php if ($business['verified']): ?>
                                        <div class="mt-2">
                                            <span class="badge bg-success small"><i
                                                    class="fa fa-check-circle me-1"></i>Verified</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No tow truck operators listed yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 5. Auto Dismantlers & Recyclers -->
    <div class="container-xxl py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div>
                    <h3 class="fw-bold mb-0">Auto Dismantlers & Recyclers</h3>
                    <p class="text-muted small mb-0">Sustainable vehicle dismantling and recycling hub</p>
                </div>
                <a href="listings.php?category=recyclers" class="btn btn-sm fw-bold px-3 py-2"
                    style="background: #F68B1E; color: #000; border: none;">
                    See All <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                <?php if ($recyclers_result && $recyclers_result->num_rows > 0): ?>
                    <?php while ($business = $recyclers_result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" class="text-decoration-none">
                                <div class="bg-white p-2 rounded shadow-sm hover-lift text-center h-100">
                                    <img src="<?php echo htmlspecialchars($business['cover_image'] ?? 'img/default-business.jpg'); ?>"
                                        class="img-fluid rounded mb-3"
                                        alt="<?php echo htmlspecialchars($business['business_name'] ?? ''); ?>"
                                        style="height: 180px; width: 100%; object-fit: cover;">
                                    <h5 class="fw-bold text-dark px-2">
                                        <?php echo htmlspecialchars($business['business_name'] ?? ''); ?>
                                    </h5>
                                    <?php if ($business['verified']): ?>
                                        <div class="mt-2">
                                            <span class="badge bg-success small"><i
                                                    class="fa fa-check-circle me-1"></i>Verified</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No recyclers listed yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Category Listings Sections End -->

    <style>
        .category-card:hover {
            transform: translateY(-5px);
            border-color: #F68B1E !important;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2) !important;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }
    </style>



    <!-- CTA Section Start -->
    <div class="container-fluid py-5" style="background: #FFB400;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2 class="mb-4 fw-bold" style="color: #000;">Are You an Automotive Service Provider?</h2>
                    <p class="mb-4 fs-5" style="color: #000;">Join hundreds of verified businesses on Auto Abuja and
                        connect with
                        thousands of potential customers looking for your services.</p>
                    <ul class="list-unstyled" style="color: #000;">
                        <li class="mb-3"><i class="fa fa-check-circle me-3" style="color: #F68B1E;"></i>Increase your
                            visibility</li>
                        <li class="mb-3"><i class="fa fa-check-circle me-3" style="color: #F68B1E;"></i>Reach more
                            customers</li>
                        <li class="mb-3"><i class="fa fa-check-circle me-3" style="color: #F68B1E;"></i>Grow your
                            business</li>
                        <li class="mb-3"><i class="fa fa-check-circle me-3" style="color: #F68B1E;"></i>Get verified
                            badge</li>
                    </ul>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="bg-white rounded-3 p-5 shadow-lg" style="border: 3px solid #F68B1E;">
                        <h4 class="mb-4 fw-bold">List Your Business</h4>
                        <p class="text-muted mb-4">Get started today and join our growing community of automotive
                            professionals</p>
                        <a href="auth.php" class="btn btn-lg w-100 py-3 mb-3 fw-bold"
                            style="background: #F68B1E; border: none; color: #000;">
                            <i class="fa fa-user-plus me-2"></i>Register Now
                        </a>
                        <p class="small text-muted mb-0">Already have an account? <a href="auth.php" class="fw-bold"
                                style="color: #F68B1E; text-decoration: underline;">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Section End -->

    <!-- Team Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase"> Our Technicians </h6>
                <h1 class="mb-5">Our Expert Technicians</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Team End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if ($carousel_ads_result && $carousel_ads_result->num_rows > 0): ?>
                    <?php
                    $active = true;
                    while ($ad = $carousel_ads_result->fetch_assoc()):
                        ?>
                        <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                            <img class="w-100" src="<?php echo htmlspecialchars($ad['image']); ?>" alt="Image">
                            <div class="carousel-caption d-flex align-items-center">
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-10 col-lg-8">
                                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                                                A.R.T.S.P Special</h5>
                                            <h1 class="display-3 text-white animated slideInDown mb-4">
                                                <?php echo htmlspecialchars($ad['title'] ?? ''); ?>
                                            </h1>
                                            <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                                <?php echo htmlspecialchars($ad['description'] ?? ''); ?>
                                            </p>
                                            <a href="<?php echo htmlspecialchars($ad['link_url'] ?? 'listings.php'); ?>"
                                                class="btn btn-primary py-3 px-5 animated slideInLeft">Discover
                                                More<i class="fa fa-arrow-right ms-3"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $active = false;
                    endwhile;
                    ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <img class="w-100" src="img/carousel-bg-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-10 col-lg-8">
                                        <h1 class="display-3 text-white animated slideInDown mb-4">Welcome
                                            to Auto Abuja</h1>
                                        <a href="listings.php"
                                            class="btn btn-primary py-3 px-5 animated slideInLeft">Discover
                                            More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- How It Works Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-uppercase mb-2" style="color: #F68B1E; font-weight: 600; letter-spacing: 2px;">Simple
                    Process</h6>
                <h2 class="mb-3 fw-bold">How It Works</h2>
                <p class="text-muted">Find the automotive services you need in three easy steps</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px; background: #000; border: 3px solid #F68B1E;">
                            <span class="display-4 text-white fw-bold">1</span>
                        </div>
                        <h5 class="mb-3 fw-bold">Search & Browse</h5>
                        <p class="text-muted">Use our search bar or browse by category to find the automotive service
                            you need</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px; background: #000; border: 3px solid #F68B1E;">
                            <span class="display-4 text-white fw-bold">2</span>
                        </div>
                        <h5 class="mb-3 fw-bold">Compare & Choose</h5>
                        <p class="text-muted">View business profiles, ratings, and contact information to make an
                            informed decision</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px; background: #000; border: 3px solid #F68B1E;">
                            <span class="display-4 text-white fw-bold">3</span>
                        </div>
                        <h5 class="mb-3 fw-bold">Connect Directly</h5>
                        <p class="text-muted">Contact the business directly via phone, WhatsApp, or visit their location
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How It Works End -->



    <!-- Advert Section Start -->
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <?php if ($promo_ads_result && $promo_ads_result->num_rows > 0): ?>
                    <?php
                    $delay = 0.1;
                    while ($ad = $promo_ads_result->fetch_assoc()):
                        ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                            <div class="ad-slot bg-white">
                                <a href="<?php echo htmlspecialchars($ad['link_url'] ?? '#'); ?>">
                                    <img class="img-fluid w-100" src="<?php echo htmlspecialchars($ad['image']); ?>"
                                        alt="<?php echo htmlspecialchars($ad['title']); ?>">
                                </a>
                            </div>
                        </div>
                        <?php
                        $delay += 0.2;
                    endwhile;
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Advert Section End -->


    <!-- Partners Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase"> Our Partners </h6>
                <h1 class="mb-5">Trusted By Leading Organizations</h1>
            </div>
            <div class="row g-4 align-items-center">
                <?php if ($partners_result && $partners_result->num_rows > 0): ?>
                    <?php
                    $delay = 0.1;
                    while ($partner = $partners_result->fetch_assoc()):
                        ?>
                        <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                            <div class="partner-item bg-light p-4 text-center">
                                <img src="<?php echo htmlspecialchars($partner['logo']); ?>"
                                    alt="<?php echo htmlspecialchars($partner['name']); ?>" class="img-fluid"
                                    style="max-height: 80px;">
                            </div>
                        </div>
                        <?php
                        $delay += 0.1;
                    endwhile;
                    ?>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5">
                <a class="btn btn-primary py-3 px-5" href="contact.php">Contact Us</a>
            </div>
        </div>
    </div>
    <!-- Partners End -->

    <!-- Testimonials Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase"> Testimonials </h6>
                <h1 class="mb-5">What Our Clients Say</h1>
            </div>
            <div class="row g-4">
                <?php if ($testimonials_result && $testimonials_result->num_rows > 0): ?>
                    <?php while ($t = $testimonials_result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="testimonial-item bg-light p-4 rounded h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="ps-3">
                                        <h5 class="fw-bold mb-1">
                                            <?php echo htmlspecialchars($t['name']); ?>
                                        </h5>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($t['position']); ?>
                                        </small>
                                    </div>
                                </div>
                                <p class="mb-0 italic">"
                                    <?php echo htmlspecialchars($t['text']); ?>"
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Testimonials End -->




    <?php include 'includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('productSearch');
            const categoryFilter = document.getElementById('categoryFilter');
            const productsGrid = document.getElementById('productsGrid');
            const productCount = document.getElementById('productCount');
            const noResults = document.getElementById('noResults');
            const wishlistBtn = document.getElementById('wishlistBtn');
            const cartBtn = document.getElementById('cartBtn');
            const wishlistCount = document.getElementById('wishlistCount');
            const cartCount = document.getElementById('cartCount');

            let wishlist = [];
            let cart = [];

            // Search and Filter Function
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const category = categoryFilter.value;
                const products = document.querySelectorAll('.product-item');
                let visibleCount = 0;

                products.forEach(product => {
                    const productName = product.getAttribute('data-name').toLowerCase();
                    const productCategory = product.getAttribute('data-category');

                    const matchesSearch = productName.includes(searchTerm);
                    const matchesCategory = category === 'all' || productCategory === category;

                    if (matchesSearch && matchesCategory) {
                        product.style.display = 'block';
                        visibleCount++;
                    } else {
                        product.style.display = 'none';
                    }
                });

                productCount.textContent = visibleCount;

                if (visibleCount === 0) {
                    noResults.classList.remove('d-none');
                } else {
                    noResults.classList.add('d-none');
                }
            }

            // Event Listeners for Search and Filter
            searchInput.addEventListener('keyup', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);

            // Wishlist Functionality
            document.querySelectorAll('.wishlist-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productName = this.getAttribute('data-product');

                    if (!wishlist.includes(productName)) {
                        wishlist.push(productName);
                        this.classList.add('text-danger');
                        this.innerHTML = '<i class="fa fa-heart"></i>';
                        showNotification(`${productName} added to wishlist!`, 'success');
                    } else {
                        wishlist = wishlist.filter(item => item !== productName);
                        this.classList.remove('text-danger');
                        this.innerHTML = '<i class="fa fa-heart"></i>';
                        showNotification(`${productName} removed from wishlist!`, 'info');
                    }

                    wishlistCount.textContent = wishlist.length;
                });
            });

            // Cart Functionality
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productName = this.getAttribute('data-product');
                    const productPrice = this.getAttribute('data-price');

                    const existingItem = cart.find(item => item.name === productName);

                    if (!existingItem) {
                        cart.push({ name: productName, price: productPrice, quantity: 1 });
                        this.innerHTML = '<i class="fa fa-check"></i> Added to Cart';
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-success');
                        showNotification(`${productName} added to cart!`, 'success');

                        setTimeout(() => {
                            this.innerHTML = '<i class="fa fa-shopping-cart"></i> Add to Cart';
                            this.classList.remove('btn-success');
                            this.classList.add('btn-primary');
                        }, 2000);
                    } else {
                        existingItem.quantity++;
                        showNotification(`${productName} quantity updated!`, 'info');
                    }

                    cartCount.textContent = cart.length;
                });
            });

            // Wishlist Button Click
            wishlistBtn.addEventListener('click', function () {
                if (wishlist.length === 0) {
                    showNotification('Your wishlist is empty!', 'warning');
                } else {
                    showNotification(`You have ${wishlist.length} item(s) in your wishlist: ${wishlist.join(', ')}`, 'info');
                }
            });

            // Cart Button Click
            cartBtn.addEventListener('click', function () {
                if (cart.length === 0) {
                    showNotification('Your cart is empty!', 'warning');
                } else {
                    let cartSummary = 'Cart Items:\n';
                    let total = 0;
                    cart.forEach(item => {
                        const itemTotal = parseInt(item.price) * item.quantity;
                        total += itemTotal;
                        cartSummary += `${item.name} (x${item.quantity}) - ₦${itemTotal.toLocaleString()}\n`;
                    });
                    cartSummary += `\nTotal: ₦${total.toLocaleString()}`;
                    alert(cartSummary);
                }
            });

            // Notification Function
            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
                notification.style.zIndex = '9999';
                notification.style.minWidth = '300px';
                notification.innerHTML = `
                    <i class="fa fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    ${message}
                `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
</body>

</html>