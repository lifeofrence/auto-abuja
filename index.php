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
                    <!-- <div class="search-container bg-white rounded-3 p-2 shadow-lg">
                        <form action="listings.php" method="GET" class="row g-2 align-items-center">
                            <div class="col-md-5">
                                <input type="text" name="search" class="form-control border-0 py-3"
                                    placeholder="What are you looking for?" style="font-size: 16px;">
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-select border-0 py-3" style="font-size: 16px;">
                                    <option value="">All Categories</option>
                                    <option value="mechanics">Auto Mechanics & Technicians</option>
                                    <option value="dealers">Automobile Dealerships</option>
                                    <option value="spare-parts">Auto Spare Parts</option>
                                    <option value="towing">Tow Truck Operators</option>
                                    <option value="recyclers">Auto Dismantlers & Recyclers</option>
                                    <option value="service-stations">Service Stations</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn w-100 py-3 fw-bold"
                                    style="background: #F68B1E; border: none; color: #000;">
                                    <i class="fa fa-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div> -->
                    <div class="row mb-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="col-lg-12">
                            <div class="bg-light p-4 rounded">
                                <div class="row g-3 align-items-center">
                                    <!-- Search Bar -->
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

                                    <!-- Category Filter -->
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

                                <!-- Results Count -->
                                <!-- <div class="mt-3">
                                    <p class="mb-0 text-muted">
                                        <i class="fa fa-info-circle me-2"></i>
                                        Showing <span id="productCount">4</span> product(s)
                                    </p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->



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
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="vehicles"
                    data-name="Benz GLE 2016">
                    <div class="card h-100 border-0 shadow">
                        <div class="position-relative">
                            <img src="img/gle.jpg" class="card-img-top" alt="Benz GLE 2016">
                            <div class="position-absolute top-0 end-0 p-2">
                                <!-- <button class="btn btn-sm btn-light rounded-circle wishlist-btn"
                                    data-product="Benz GLE 2016" title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Benz GLE 2016</h5>
                            <h4 class="mb-3" style="color: #F68B1E;">₦15,000,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-001</p>
                            <button class="btn w-100 mb-2 add-to-cart" data-product="Benz GLE 2016"
                                data-price="15000000" style="background: #F68B1E; border: none; color: #000;">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-dark w-100 btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="0.3s" data-category="vehicles"
                    data-name="Camry 08">
                    <div class="card h-100 border-0 shadow">
                        <div class="position-relative">
                            <img src="img/camry08.jpg" class="card-img-top" alt="Camry 08">
                            <div class="position-absolute top-0 end-0 p-2">
                                <!-- <button class="btn btn-sm btn-light rounded-circle wishlist-btn" data-product="Camry 08"
                                    title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Camry 08</h5>
                            <h4 class="mb-3" style="color: #F68B1E;">₦2,500,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-002</p>
                            <button class="btn w-100 mb-2 add-to-cart" data-product="Camry 08" data-price="2500000"
                                style="background: #F68B1E; border: none; color: #000;">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-dark w-100 btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="0.5s" data-category="vehicles"
                    data-name="EV Car">
                    <div class="card h-100 border-0 shadow">
                        <div class="position-relative">
                            <img src="img/ev.jpg" class="card-img-top" alt="EV Car">
                            <div class="position-absolute top-0 end-0 p-2">
                                <!-- <button class="btn btn-sm btn-light rounded-circle wishlist-btn" data-product="EV Car"
                                    title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">EV Car</h5>
                            <h4 class="mb-3" style="color: #F68B1E;">₦8,000,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-003</p>
                            <button class="btn w-100 mb-2 add-to-cart" data-product="EV Car" data-price="8000000"
                                style="background: #F68B1E; border: none; color: #000;">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-dark w-100 btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="0.7s" data-category="services"
                    data-name="Car Servicing">
                    <div class="card h-100 border-0 shadow">
                        <div class="position-relative">
                            <img src="img/service.jpg" class="card-img-top" alt="Servicing">
                            <div class="position-absolute top-0 end-0 p-2">
                                <!-- <button class="btn btn-sm btn-light rounded-circle wishlist-btn"
                                    data-product="Car Servicing" title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Car Servicing</h5>
                            <h4 class="mb-3" style="color: #F68B1E;">₦50,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available:
                                Unlimited</p>
                            <p class="text-secondary mb-3 small">Quote Product #: SRV-001</p>
                            <button class="btn w-100 mb-2 add-to-cart" data-product="Car Servicing" data-price="50000"
                                style="background: #F68B1E; border: none; color: #000;">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-dark w-100 btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
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
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/mechanic_1.png" class="card-img-top" alt="QuickFix Auto"
                                style="height: 180px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-success"><i class="fa fa-check-circle me-1"></i>Verified</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">QuickFix Auto Workshop</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(48)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Garki 2, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <!-- More items for Mechanics can be added here -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/service-1.jpg" class="card-img-top" alt="Premium Care"
                                style="height: 180px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-primary">Top Rated</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Premium Engine Care</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                                <span class="text-muted ms-1">(32)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Wuse II, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/service-2.jpg" class="card-img-top" alt="Elite Workshop"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Elite Auto Workshop</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="far fa-star"></i>
                                <span class="text-muted ms-1">(25)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Maitama, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/service-3.jpg" class="card-img-top" alt="Precision Tech"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Precision Technicians</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(19)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Asokoro, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
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
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/dealer_1.png" class="card-img-top" alt="Metro Motors"
                                style="height: 180px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-success"><i class="fa fa-check-circle me-1"></i>Verified</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Metro Motors Abuja</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(124)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Central Area,
                                Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/gle.jpg" class="card-img-top" alt="Elite Cars"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Elite Car Sales</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="far fa-star"></i>
                                <span class="text-muted ms-1">(86)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Maitama, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/camry08.jpg" class="card-img-top" alt="Unity Dealers"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Unity Auto Dealers</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(54)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Gudu, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/ev.jpg" class="card-img-top" alt="Future Motors"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Future Motors EV</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                                <span class="text-muted ms-1">(21)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Jabi, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
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
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/parts_1.png" class="card-img-top" alt="Genuine Parts Hub"
                                style="height: 180px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-success"><i class="fa fa-check-circle me-1"></i>Verified</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Genuine Parts Hub</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(215)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Apo Mechanic
                                Village</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/service-4.jpg" class="card-img-top" alt="Master Parts"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Master Spare Parts</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="far fa-star"></i>
                                <span class="text-muted ms-1">(42)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Gwagwalada, Abuja
                            </p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/tools.webp" class="card-img-top" alt="Abuja Parts"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Abuja Parts World</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span class="text-muted ms-1">(93)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Central Area,
                                Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative">
                            <img src="img/service.jpg" class="card-img-top" alt="Brake Specialist"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">Brake & Suspension Hub</h6>
                            <div class="text-warning small mb-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                                <span class="text-muted ms-1">(15)</span>
                            </div>
                            <p class="text-muted small mb-3"><i class="fa fa-map-marker-alt me-2"></i>Kuje, Abuja</p>
                            <a href="#" class="btn btn-outline-dark btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Tow Truck Operators & More (Compact Grid) -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-uppercase mb-2" style="color: #F68B1E; font-weight: 600; letter-spacing: 2px;">
                    Additional Categories</h6>
                <h2 class="mb-3 fw-bold">Tow Truck, Recycling & Service Stations</h2>
            </div>
            <div class="row g-4">
                <!-- Tow Truck Operators -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-white rounded-3 p-4 shadow-sm hover-lift border-0 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box rounded-circle bg-dark d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-truck-pickup text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Tow Truck Operators</h5>
                        </div>
                        <ul class="list-unstyled mb-4 small text-muted">
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>24/7 Emergency Towing</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Flatbed & Wheel-Lift</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Verified Operators</li>
                        </ul>
                        <a href="listings.php?category=towing" class="btn btn-outline-dark w-100 btn-sm">Explore Towing
                            Services</a>
                    </div>
                </div>
                <!-- Auto Dismantlers & Recyclers -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-white rounded-3 p-4 shadow-sm hover-lift border-0 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box rounded-circle bg-dark d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-recycle text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Auto Dismantlers</h5>
                        </div>
                        <ul class="list-unstyled mb-4 small text-muted">
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Eco-Friendly Recycling</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Used Parts Recovery</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Scrap Car Disposal</li>
                        </ul>
                        <a href="listings.php?category=recyclers" class="btn btn-outline-dark w-100 btn-sm">Explore
                            Recycling</a>
                    </div>
                </div>
                <!-- Service Stations -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-white rounded-3 p-4 shadow-sm hover-lift border-0 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box rounded-circle bg-dark d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-gas-pump text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Service Stations</h5>
                        </div>
                        <ul class="list-unstyled mb-4 small text-muted">
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Full Service Fueling</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Quick Lube & Car Wash</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Convenience Stores</li>
                        </ul>
                        <a href="listings.php?category=service-stations"
                            class="btn btn-outline-dark w-100 btn-sm">Explore Stations</a>
                    </div>
                </div>
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

    <!-- Advert Section Start -->
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="ad-slot bg-white">
                        <a href="listings.php?category=spare-parts">
                            <img class="img-fluid w-100" src="img/promo_parts.png" alt="Spare Parts Deal">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="ad-slot bg-white">
                        <a href="service.php">
                            <img class="img-fluid w-100" src="img/promo_service.png" alt="Mechanic Service deal">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="ad-slot bg-white">
                        <a href="business.php">
                            <img class="img-fluid w-100" src="img/promo_dealer.png" alt="Verified Dealers deal">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Advert Section End -->


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





    <!-- Partners Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase"> Our Partners </h6>
                <h1 class="mb-5">Trusted By Leading Organizations</h1>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/npf.jpg" alt="Nigeria Police Force" class="img-fluid" style="max-height: 80px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/son.webp" alt="Standards Organisation of Nigeria (SON)" class="img-fluid"
                            style="max-height: 80px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/customs.jpg" alt="Nigeria Customs Service" class="img-fluid"
                            style="max-height: 80px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/amdon.png" alt="Amdon" class="img-fluid" style="max-height: 80px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/naddc.jpeg" alt="National Automotive Design and Development Council (NADDC)"
                            class="img-fluid" style="max-height: 80px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="partner-item bg-light p-4 text-center">
                        <img src="img/frsc.png" alt="Federal Road Safety Corps (FRSC)" class="img-fluid"
                            style="max-height: 80px;">
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a class="btn btn-primary py-3 px-5" href="contact.php">Contact Us</a>
            </div>
        </div>
    </div>
    <!-- Partners End -->


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