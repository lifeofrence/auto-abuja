<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small>No. 35 Lusaka Street, Wuse Zone 6, Abuja, Nigeria</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-primary me-2"></small>
                <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small>(+234) 803 787 9981</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>A.R.T.S.P</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About Us</a>
            <!-- <a href="business.php" class="nav-item nav-link">Businesses</a> -->
            <!-- <a href="product.php" class="nav-item nav-link">Products</a> -->
            <!-- <a href="service.php" class="nav-item nav-link">Services</a> -->
            <a href="team.php" class="nav-item nav-link">Owner</a>
            <!-- <a href="faq.php" class="nav-item nav-link">FAQ</a> -->
        </div>

        <!-- Wishlist and Cart Buttons -->
        <!-- <div class="d-flex align-items-center me-3">
            <button class="btn btn-outline-danger me-2" id="wishlistBtn" style="border-radius: 25px;">
                <i class="fa fa-heart"></i> <span class="d-none d-lg-inline">Wishlist</span> (<span
                    id="wishlistCount">0</span>)
            </button>
            <button class="btn btn-outline-dark" id="cartBtn" style="border-radius: 25px;">
                <i class="fa fa-shopping-cart"></i> <span class="d-none d-lg-inline">Cart</span> (<span
                    id="cartCount">0</span>)
            </button>
        </div> -->

        <?php if (is_logged_in()): ?>
            <div class="nav-item dropdown d-none d-lg-block">
                <a href="#" class="nav-link dropdown-toggle btn btn-primary py-4 px-lg-5 text-white"
                    data-bs-toggle="dropdown">
                    <i class="fa fa-user-circle me-2"></i>
                    <?php echo explode(' ', $_SESSION['name'])[0]; ?>
                </a>
                <div class="dropdown-menu fade-up m-0 shadow-sm border-0">
                    <a href="dashboard.php" class="dropdown-item"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="profile-edit.php" class="dropdown-item"><i class="fa fa-user-edit me-2"></i>Profile</a>
                    <a href="logout.php" class="dropdown-item text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
            <!-- Mobile login link -->
            <a href="dashboard.php" class="nav-item nav-link d-lg-none">Dashboard</a>
            <a href="logout.php" class="nav-item nav-link d-lg-none text-danger">Logout</a>
        <?php else: ?>
            <a href="auth.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                <i class="fa fa-user me-2"></i> Login / Register
            </a>
            <a href="auth.php" class="nav-item nav-link d-lg-none">Login / Register</a>
        <?php endif; ?>

    </div>
</nav>
<!-- Navbar End -->