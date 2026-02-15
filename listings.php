<?php
require_once 'includes/config.php';

// Get filter parameters
$category_slug = isset($_GET['category']) ? sanitize_input($_GET['category']) : '';
$subcategory_slug = isset($_GET['sub']) ? sanitize_input($_GET['sub']) : '';
$search = isset($_GET['search']) ? sanitize_input($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * ITEMS_PER_PAGE;

// Build query
$where_clauses = ["b.status = 'approved'"];
$joins = "";

if ($category_slug) {
    $joins .= " INNER JOIN categories c ON b.category_id = c.id AND c.slug = '$category_slug'";
}

if ($subcategory_slug) {
    $joins .= " INNER JOIN subcategories sc ON b.subcategory_id = sc.id AND sc.slug = '$subcategory_slug'";
}

if ($search) {
    $where_clauses[] = "(b.business_name LIKE '%$search%' OR b.description LIKE '%$search%' OR b.address LIKE '%$search%')";
}

$where_sql = implode(' AND ', $where_clauses);

// Get total count
$count_query = "SELECT COUNT(*) as total FROM businesses b $joins WHERE $where_sql";
$count_result = $conn->query($count_query);
$total_businesses = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_businesses / ITEMS_PER_PAGE);

// Get businesses
$query = "SELECT b.*, c.name as category_name, c.slug as category_slug, 
          sc.name as subcategory_name, sc.slug as subcategory_slug, sc.badge_color,
          u.name as owner_name, u.phone as owner_phone
          FROM businesses b
          LEFT JOIN categories c ON b.category_id = c.id
          LEFT JOIN subcategories sc ON b.subcategory_id = sc.id
          LEFT JOIN users u ON b.user_id = u.id
          $joins
          WHERE $where_sql
          ORDER BY b.is_featured DESC, b.created_at DESC
          LIMIT " . ITEMS_PER_PAGE . " OFFSET $offset";

$result = $conn->query($query);

// Get all categories for filter
$categories_query = "SELECT * FROM categories WHERE is_active = TRUE ORDER BY display_order";
$categories_result = $conn->query($categories_query);

// Get subcategories if category is selected
$subcategories = [];
if ($category_slug) {
    $subcat_query = "SELECT sc.* FROM subcategories sc 
                     INNER JOIN categories c ON sc.category_id = c.id 
                     WHERE c.slug = '$category_slug' AND sc.is_active = TRUE 
                     ORDER BY sc.display_order";
    $subcat_result = $conn->query($subcat_query);
    while ($row = $subcat_result->fetch_assoc()) {
        $subcategories[] = $row;
    }
}

// Page title
$page_title = "Business Listings";
if ($category_slug) {
    $cat_query = "SELECT name FROM categories WHERE slug = '$category_slug' LIMIT 1";
    $cat_result = $conn->query($cat_query);
    if ($cat_result->num_rows > 0) {
        $page_title = $cat_result->fetch_assoc()['name'];
    }
}
if ($subcategory_slug) {
    $subcat_query = "SELECT name FROM subcategories WHERE slug = '$subcategory_slug' LIMIT 1";
    $subcat_result = $conn->query($subcat_query);
    if ($subcat_result->num_rows > 0) {
        $page_title .= " - " . $subcat_result->fetch_assoc()['name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?> - Auto Abuja Directory</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Auto Services Directory, Abuja Automotive, Car Services" name="keywords">
    <meta content="Find trusted automotive businesses in Abuja" name="description">

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
        .listing-card {
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            height: 100%;
        }

        .listing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .listing-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .badge-featured {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #FFB400;
            color: #000;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .rating-stars {
            color: #FFB400;
        }

        #map {
            height: 500px;
            width: 100%;
            border-radius: 10px;
        }

        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .business-contact {
            font-size: 14px;
        }

        .business-contact i {
            width: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo $page_title; ?></h1>
                <p class="text-white fs-5"><?php echo $total_businesses; ?> Business<?php echo $total_businesses != 1 ? 'es' : ''; ?> Found</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Listings Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Search and Filter Section -->
            <div class="filter-section">
                <form method="GET" action="listings.php" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search businesses..." 
                               value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category" id="categorySelect" onchange="loadSubcategories()">
                            <option value="">All Categories</option>
                            <?php 
                            $categories_result->data_seek(0);
                            while ($cat = $categories_result->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $cat['slug']; ?>" 
                                        <?php echo $category_slug === $cat['slug'] ? 'selected' : ''; ?>>
                                    <?php echo $cat['name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="sub" id="subcategorySelect">
                            <option value="">All Subcategories</option>
                            <?php foreach ($subcategories as $subcat): ?>
                                <option value="<?php echo $subcat['slug']; ?>" 
                                        <?php echo $subcategory_slug === $subcat['slug'] ? 'selected' : ''; ?>>
                                    <?php echo $subcat['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-search me-2"></i>Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- View Toggle -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Showing <?php echo min($offset + 1, $total_businesses); ?> - 
                    <?php echo min($offset + ITEMS_PER_PAGE, $total_businesses); ?> of <?php echo $total_businesses; ?> results</h5>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" onclick="showGridView()">
                        <i class="fa fa-th"></i> Grid
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="showMapView()">
                        <i class="fa fa-map"></i> Map
                    </button>
                </div>
            </div>

            <!-- Grid View -->
            <div id="gridView" class="row g-4">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($business = $result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card listing-card">
                                <div class="position-relative">
                                    <img src="<?php echo $business['cover_image'] ?: 'img/default-business.jpg'; ?>" 
                                         class="card-img-top listing-image" alt="<?php echo htmlspecialchars($business['business_name']); ?>">
                                    <?php if ($business['is_featured']): ?>
                                        <span class="badge-featured">
                                            <i class="fa fa-star"></i> Featured
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">
                                            <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" 
                                               class="text-decoration-none text-dark">
                                                <?php echo htmlspecialchars($business['business_name']); ?>
                                            </a>
                                        </h5>
                                        <?php if ($business['verified']): ?>
                                            <span class="badge bg-success" title="Verified Business">
                                                <i class="fa fa-check-circle"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($business['subcategory_name']): ?>
                                        <span class="badge bg-<?php echo $business['badge_color'] ?: 'primary'; ?> mb-2">
                                            <?php echo $business['subcategory_name']; ?>
                                        </span>
                                    <?php endif; ?>

                                    <p class="card-text text-muted small mb-2">
                                        <?php echo substr(htmlspecialchars($business['description']), 0, 100); ?>...
                                    </p>

                                    <div class="business-contact mb-2">
                                        <div class="mb-1">
                                            <i class="fa fa-map-marker-alt text-primary"></i>
                                            <small><?php echo htmlspecialchars($business['address']); ?></small>
                                        </div>
                                        <div class="mb-1">
                                            <i class="fa fa-phone text-primary"></i>
                                            <small><?php echo htmlspecialchars($business['phone']); ?></small>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="rating-stars">
                                            <?php 
                                            $rating = round($business['rating_average']);
                                            for ($i = 1; $i <= 5; $i++): 
                                            ?>
                                                <i class="fa<?php echo $i <= $rating ? 's' : 'r'; ?> fa-star"></i>
                                            <?php endfor; ?>
                                            <small class="text-muted">(<?php echo $business['rating_count']; ?>)</small>
                                        </div>
                                        <a href="business-detail.php?slug=<?php echo $business['slug']; ?>" 
                                           class="btn btn-sm btn-primary">
                                            View Details <i class="fa fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fa fa-info-circle fa-3x mb-3"></i>
                            <h4>No businesses found</h4>
                            <p>Try adjusting your search or filter criteria</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Map View -->
            <div id="mapView" style="display: none;">
                <div id="map"></div>
                <div class="mt-3" id="mapListings"></div>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?category=<?php echo $category_slug; ?>&sub=<?php echo $subcategory_slug; ?>&search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?category=<?php echo $category_slug; ?>&sub=<?php echo $subcategory_slug; ?>&search=<?php echo $search; ?>&page=<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?category=<?php echo $category_slug; ?>&sub=<?php echo $subcategory_slug; ?>&search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>">
                                    Next
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
    <!-- Listings End -->

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>"></script>

    <script>
        let map;
        let markers = [];
        const businesses = <?php 
            $result->data_seek(0);
            $businesses_array = [];
            while ($b = $result->fetch_assoc()) {
                if ($b['latitude'] && $b['longitude']) {
                    $businesses_array[] = $b;
                }
            }
            echo json_encode($businesses_array);
        ?>;

        function initMap() {
            // Center on Abuja
            const center = { lat: 9.0765, lng: 7.3986 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: center
            });

            // Add markers for each business
            businesses.forEach(business => {
                const marker = new google.maps.Marker({
                    position: { lat: parseFloat(business.latitude), lng: parseFloat(business.longitude) },
                    map: map,
                    title: business.business_name
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="max-width: 250px;">
                            <h6>${business.business_name}</h6>
                            <p class="small mb-1">${business.address}</p>
                            <p class="small mb-2">${business.phone}</p>
                            <a href="business-detail.php?slug=${business.slug}" class="btn btn-sm btn-primary">
                                View Details
                            </a>
                        </div>
                    `
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            });
        }

        function showGridView() {
            document.getElementById('gridView').style.display = 'flex';
            document.getElementById('mapView').style.display = 'none';
        }

        function showMapView() {
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('mapView').style.display = 'block';
            if (!map) {
                initMap();
            }
        }

        function loadSubcategories() {
            const category = document.getElementById('categorySelect').value;
            // This would typically make an AJAX call to get subcategories
            // For now, the form will submit and reload with the new category
            if (!category) {
                document.getElementById('subcategorySelect').innerHTML = '<option value="">All Subcategories</option>';
            }
        }
    </script>
</body>

</html>
