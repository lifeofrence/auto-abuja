<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CarServ - Car Repair HTML Template</title>
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
                <h1 class="display-3 text-white mb-3 animated slideInDown">Products</h1>

            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Products Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!-- <h1 class="mb-5">Available Products</h1> -->
            </div>

            <!-- Search and Cart Section -->
            <div class="row mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-lg-12">
                    <div class="bg-light p-4 rounded">
                        <div class="row g-3 align-items-center">
                            <!-- Search Bar -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="productSearch"
                                        placeholder="Search for products (e.g., Benz, Camry, EV)...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-lg-3">
                                <select class="form-select" id="categoryFilter">
                                    <option value="all">All Categories</option>
                                    <option value="vehicles">Vehicles</option>
                                    <option value="services">Services</option>
                                    <option value="parts">Spare Parts</option>
                                </select>
                            </div>

                            <!-- Wishlist and Cart -->
                            <div class="col-lg-3 text-end">
                                <button class="btn btn-outline-danger me-2" id="wishlistBtn">
                                    <i class="fa fa-heart"></i> Wishlist (<span id="wishlistCount">0</span>)
                                </button>
                                <button class="btn btn-outline-primary" id="cartBtn">
                                    <i class="fa fa-shopping-cart"></i> Cart (<span id="cartCount">0</span>)
                                </button>
                            </div>
                        </div>

                        <!-- Results Count -->
                        <div class="mt-3">
                            <p class="mb-0 text-muted">
                                <i class="fa fa-info-circle me-2"></i>
                                Showing <span id="productCount">4</span> product(s)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row g-4" id="productsGrid">
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="vehicles"
                    data-name="Benz GLE 2016">
                    <div class="card h-100 border-0 shadow">
                        <div class="position-relative">
                            <img src="img/gle.jpg" class="card-img-top" alt="Benz GLE 2016">
                            <div class="position-absolute top-0 end-0 p-2">
                                <button class="btn btn-sm btn-light rounded-circle wishlist-btn"
                                    data-product="Benz GLE 2016" title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Benz GLE 2016</h5>
                            <h4 class="text-primary mb-3">₦15,000,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-001</p>
                            <button class="btn btn-primary w-100 mb-2 add-to-cart" data-product="Benz GLE 2016"
                                data-price="15000000">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-primary w-100 btn-sm">View Details</a>
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
                                <button class="btn btn-sm btn-light rounded-circle wishlist-btn" data-product="Camry 08"
                                    title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Camry 08</h5>
                            <h4 class="text-primary mb-3">₦2,500,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-002</p>
                            <button class="btn btn-primary w-100 mb-2 add-to-cart" data-product="Camry 08"
                                data-price="2500000">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-primary w-100 btn-sm">View Details</a>
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
                                <button class="btn btn-sm btn-light rounded-circle wishlist-btn" data-product="EV Car"
                                    title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">EV Car</h5>
                            <h4 class="text-primary mb-3">₦8,000,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available: 6</p>
                            <p class="text-secondary mb-3 small">Quote Product #: VEH-003</p>
                            <button class="btn btn-primary w-100 mb-2 add-to-cart" data-product="EV Car"
                                data-price="8000000">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-primary w-100 btn-sm">View Details</a>
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
                                <button class="btn btn-sm btn-light rounded-circle wishlist-btn"
                                    data-product="Car Servicing" title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Car Servicing</h5>
                            <h4 class="text-primary mb-3">₦50,000</h4>
                            <p class="text-muted mb-2"><i class="fa fa-check-circle text-success"></i> Available:
                                Unlimited</p>
                            <p class="text-secondary mb-3 small">Quote Product #: SRV-001</p>
                            <button class="btn btn-primary w-100 mb-2 add-to-cart" data-product="Car Servicing"
                                data-price="50000">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <a href="#" class="btn btn-outline-primary w-100 btn-sm">View Details</a>
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
    <!-- Products End -->

    <!-- Product Search & Cart Script -->
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



    <?php include 'includes/footer.php'; ?>
</body>

</html>