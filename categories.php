<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Browse Categories - A.R.T.S.P</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Auto Services Directory, Abuja Automotive, Car Services" name="keywords">
    <meta content="Browse automotive service categories and subcategories in Abuja" name="description">

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
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Browse Categories</h1>
                <p class="text-white fs-5">Find Automotive Services by Category</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Categories Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">Service Categories</h6>
                <h1 class="mb-5">Explore Our Service Categories</h1>
            </div>

            <div class="row g-4">
                <!-- Category 1: Auto Mechanics -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-wrench fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Auto Mechanics & Technicians</h4>
                                <p class="text-muted mb-4">Find certified mechanics and workshops for all your vehicle
                                    repair needs</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=mechanics&sub=grade-a"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            <span class="badge bg-success me-2">Grade A</span> Standardized Workshops
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=mechanics&sub=grade-b"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            <span class="badge bg-info me-2">Grade B</span> Regular Mechanics
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=mechanics&sub=grade-c"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            <span class="badge bg-warning me-2">Grade C</span> Petty Mechanics
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=mechanics" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Mechanics
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Auto Dealers -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-car fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Automobile Dealerships</h4>
                                <p class="text-muted mb-4">Connect with reliable car dealers and showrooms</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=dealers&sub=new-vehicles"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            New Vehicle Dealers
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=dealers&sub=tokunbo"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Used Vehicles (Tokunbo)
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=dealers&sub=local-used"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Local Used Vehicles
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=dealers" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Dealers
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 3: Spare Parts -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-cogs fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Auto Spare Parts</h4>
                                <p class="text-muted mb-4">Genuine spare parts for various car models</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=spare-parts&sub=heavy-duty"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Heavy Duty Parts
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=spare-parts&sub=light-duty"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Light Duty Parts
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=spare-parts&sub=accessories"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Accessories
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=spare-parts" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Parts
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 4: Tow Trucks -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-truck-pickup fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Tow Truck Operators</h4>
                                <p class="text-muted mb-4">24/7 towing services for emergencies</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=towing&sub=emergency"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Emergency Towing
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=towing&sub=heavy-duty"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Heavy Duty Towing
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=towing" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Operators
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 5: Dismantlers & Recyclers -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-recycle fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Auto Dismantlers & Recyclers</h4>
                                <p class="text-muted mb-4">Eco-friendly disposal and parts recycling</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=recyclers&sub=dismantlers"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Vehicle Dismantlers
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=recyclers&sub=parts-recycling"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Parts Recycling
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=recyclers" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Services
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 6: Service Stations -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="card h-100 border-0 shadow-lg category-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa fa-gas-pump fa-3x"></i>
                                </div>
                                <h4 class="card-title mb-3">Service Stations</h4>
                                <p class="text-muted mb-4">Fuel stations and quick service centers</p>
                            </div>

                            <div class="subcategories mb-4">
                                <h6 class="text-primary mb-3">Subcategories:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a href="listings.php?category=service-stations&sub=fuel"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Fuel Stations
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="listings.php?category=service-stations&sub=quick-service"
                                            class="text-decoration-none">
                                            <i class="fa fa-chevron-right text-primary me-2"></i>
                                            Quick Service Centers
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="listings.php?category=service-stations" class="btn btn-primary w-100">
                                <i class="fa fa-search me-2"></i>View All Stations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->

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

    <style>
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .subcategories a {
            color: #495057;
            transition: all 0.3s ease;
            display: block;
            padding: 5px 0;
        }

        .subcategories a:hover {
            color: #06A3DA;
            padding-left: 10px;
        }
    </style>
</body>

</html>