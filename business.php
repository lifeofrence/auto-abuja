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

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Businesses</h1>

            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Businesses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!-- <h6 class="text-primary text-uppercase"> Our Businesses </h6> -->
                <h1 class="mb-5">Registered Automotive Businesses</h1>
            </div>

            <!-- Search and Filter Section -->
            <div class="row mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-lg-12">
                    <div class="bg-light p-4 rounded">
                        <form id="searchForm">
                            <div class="row g-3">
                                <!-- Search Input -->
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa fa-search text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0" id="searchInput"
                                            placeholder="Search businesses by name...">
                                    </div>
                                </div>

                                <!-- Category Filter -->
                                <div class="col-lg-4">
                                    <select class="form-select" id="categoryFilter">
                                        <option value="">All Categories</option>
                                        <option value="workshop">Auto Mechanics & Workshops</option>
                                        <option value="dealer-new">New Vehicle Dealers</option>
                                        <option value="dealer-used">Used Vehicle Dealers (Tokunbo)</option>
                                        <option value="dealer-local">Local Used Vehicle Dealers</option>
                                        <option value="spare-parts">Spare Parts Dealers</option>
                                        <option value="service-station">Service Stations</option>
                                    </select>
                                </div>

                                <!-- Search Button -->
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results Count -->
            <div class="row mb-3">
                <div class="col-12">
                    <p class="text-muted" id="resultsCount">Showing <span id="count">12</span> businesses</p>
                </div>
            </div>

            <div class="row g-4" id="businessGrid">
                <!-- Business 1 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" data-category="workshop">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Access Solution</h5>
                            <p class="card-text mb-4">Deals in services and repairs of vehicles in an organized
                                automated workshop</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:09084847474" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 2 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s" data-category="dealer-new">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Maradona Limited</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of brand new
                                vehicles, i.e that has manufacturer retailership</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:08980989790" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 3 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Maradonal Estate Ltd</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:09898787867" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 4 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">kjabfja</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:08163720015" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 5 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s" data-category="dealer-local">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">MCENA STUDIOS</h5>
                            <p class="card-text mb-4">Buyers and Sellers of locally used Vehicles</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:78367467467" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 6 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s" data-category="service-station">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Mann Little Inc</h5>
                            <p class="card-text mb-4">Regular Mechanics & Technicians that deal in services & repairs of
                                vehicles, service stations</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:82" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 7 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s" data-category="workshop">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">ASSSL</h5>
                            <p class="card-text mb-4">Deals in services and repairs of vehicles in an organized
                                automated workshop</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:98879089768" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 8 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">MANUEL HOLDINGS</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:09816543212" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 9 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.9s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">n kj</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:90098000000" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 10 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.0s" data-category="spare-parts">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">fduyerygf erdfyugerfy</h5>
                            <p class="card-text mb-4">Spare Parts Dealers that sell and distribute Heavy & Light Duty,
                                Earthmoving Vehicles</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:54635465635" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 11 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.1s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">ojh</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:78899888898" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business 12 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s" data-category="dealer-used">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">MCDDDDDDD</h5>
                            <p class="card-text mb-4">Dealers that engage in sale and distribution of foreign use
                                vehicles, i.e Tokunbo</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary flex-fill">Visit Store</a>
                                <a href="tel:00000000000" class="btn btn-outline-primary flex-fill">Call Owner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Businesses End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Contact Us</h4>
                    <p class="mb-4">To empower every vehicle owner with the knowledge, tools, and support they need to
                        maintain their cars with confidence and ease.</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>No. 35 Lusaka Street, Wuse Zone 6, Abuja,
                        Nigeria</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(+234) 803 787 9981</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>Info@quionltd.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Main Menu</h4>
                    <a class="btn btn-link" href="index.php">Home</a>
                    <a class="btn btn-link" href="about.php">About Us</a>
                    <a class="btn btn-link" href="team.php">Team</a>
                    <a class="btn btn-link" href="faq.php">F.A.Q</a>
                    <a class="btn btn-link" href="business.php">Search</a>
                    <a class="btn btn-link" href="contact.php">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="#">Sign In</a>
                    <a class="btn btn-link" href="#">Register</a>
                    <a class="btn btn-link" href="#">Forgot Password</a>
                    <a class="btn btn-link" href="#">Claim Business</a>
                    <a class="btn btn-link" href="mailto:info@artsp.com.ng">Send an Email</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Join Our Newsletter Now</h4>
                    <p>We'll never share your email address with a third-party.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">A.R.T.S.P</a>, All Right Reserved.
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Business Search and Filter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const searchForm = document.getElementById('searchForm');
            const businessGrid = document.getElementById('businessGrid');
            const countSpan = document.getElementById('count');

            // Function to filter businesses
            function filterBusinesses() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
                const businesses = businessGrid.querySelectorAll('.col-lg-4');
                let visibleCount = 0;

                businesses.forEach(business => {
                    const businessName = business.querySelector('.card-title').textContent.toLowerCase();
                    const businessDesc = business.querySelector('.card-text').textContent.toLowerCase();
                    const businessCategory = business.dataset.category || '';

                    const matchesSearch = businessName.includes(searchTerm) || businessDesc.includes(searchTerm);
                    const matchesCategory = !selectedCategory || businessCategory === selectedCategory;

                    if (matchesSearch && matchesCategory) {
                        business.style.display = '';
                        visibleCount++;
                    } else {
                        business.style.display = 'none';
                    }
                });

                // Update count
                countSpan.textContent = visibleCount;

                // Show message if no results
                let noResultsMsg = document.getElementById('noResults');
                if (visibleCount === 0) {
                    if (!noResultsMsg) {
                        noResultsMsg = document.createElement('div');
                        noResultsMsg.id = 'noResults';
                        noResultsMsg.className = 'col-12 text-center py-5';
                        noResultsMsg.innerHTML = '<div class="alert alert-info"><i class="fa fa-info-circle me-2"></i>No businesses found matching your search criteria.</div>';
                        businessGrid.appendChild(noResultsMsg);
                    }
                } else {
                    if (noResultsMsg) {
                        noResultsMsg.remove();
                    }
                }
            }

            // Event listeners
            searchForm.addEventListener('submit', function (e) {
                e.preventDefault();
                filterBusinesses();
            });

            searchInput.addEventListener('input', filterBusinesses);
            categoryFilter.addEventListener('change', filterBusinesses);
        });
    </script>
</body>

</html>