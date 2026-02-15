<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login / Register - A.R.T.S.P</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Login, Register, A.R.T.S.P Account" name="keywords">
    <meta content="Login or register for A.R.T.S.P to access automotive services in Abuja" name="description">

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

    <!-- Custom Auth Styles -->
    <style>
        .auth-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5f8d 50%, #06A3DA 100%);
            padding: 80px 20px;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            min-height: 600px;
        }

        .auth-sidebar {
            background: linear-gradient(135deg, #06A3DA 0%, #1e3a5f 100%);
            color: white;
            padding: 60px 40px;
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .auth-sidebar h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .auth-sidebar p {
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .auth-sidebar .feature-list {
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .auth-sidebar .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .auth-sidebar .feature-item i {
            font-size: 1.2rem;
            margin-right: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-content {
            padding: 60px 50px;
            width: 60%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            border-bottom: 2px solid #e9ecef;
        }

        .auth-tab {
            padding: 15px 30px;
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            color: #06A3DA;
        }

        .auth-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #06A3DA;
        }

        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            height: 55px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #06A3DA;
            box-shadow: 0 0 0 0.2rem rgba(6, 163, 218, 0.25);
        }

        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            height: 55px;
        }

        .btn-auth {
            background: linear-gradient(135deg, #06A3DA 0%, #1e3a5f 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(6, 163, 218, 0.3);
            color: white;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #6c757d;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn-social {
            flex: 1;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: white;
            color: #6c757d;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-social:hover {
            border-color: #06A3DA;
            color: #06A3DA;
            transform: translateY(-2px);
        }

        .forgot-password {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .forgot-password a {
            color: #06A3DA;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .terms-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 15px;
            text-align: center;
        }

        .terms-text a {
            color: #06A3DA;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
            }

            .auth-sidebar,
            .auth-content {
                width: 100%;
            }

            .auth-sidebar {
                padding: 40px 30px;
            }

            .auth-content {
                padding: 40px 30px;
            }

            .auth-tabs {
                justify-content: center;
            }

            .social-login {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="auth-container">

        <div class="auth-card">
            <!-- Sidebar -->
            <div class="auth-sidebar">
                <h2>Welcome to A.R.T.S.P</h2>
                <p>Automotive Resource & Technical Service Platform - Your trusted partner for all automotive needs in
                    Abuja.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fa fa-check-circle"></i>
                        <span>Access verified mechanics and workshops</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check-circle"></i>
                        <span>Browse quality automotive products</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check-circle"></i>
                        <span>Book services online</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check-circle"></i>
                        <span>Track your service history</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check-circle"></i>
                        <span>Get expert automotive advice</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="auth-content">
                <!-- Tabs -->
                <div class="auth-tabs">
                    <button class="auth-tab active" onclick="switchTab('login')">
                        <i class="fa fa-sign-in-alt me-2"></i> Login
                    </button>
                    <button class="auth-tab" onclick="switchTab('register')">
                        <i class="fa fa-user-plus me-2"></i> Register
                    </button>
                </div>

                <!-- Login Form -->
                <div id="loginForm" class="auth-form active">
                    <h3 class="mb-4">Sign In to Your Account</h3>

                    <form>
                        <div class="form-floating">
                            <input type="email" class="form-control" id="loginEmail" placeholder="Email Address"
                                required>
                            <label for="loginEmail">Email Address</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="loginPassword" placeholder="Password"
                                required>
                            <label for="loginPassword">Password</label>
                        </div>

                        <div class="forgot-password">
                            <a href="#" onclick="showForgotPassword()">Forgot Password?</a>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-auth">
                            <i class="fa fa-sign-in-alt me-2"></i> Sign In
                        </button>
                    </form>

                    <div class="divider">
                        <span>OR CONTINUE WITH</span>
                    </div>

                    <div class="social-login">
                        <button class="btn-social">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button class="btn-social">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                    </div>
                </div>

                <!-- Register Form -->
                <div id="registerForm" class="auth-form">
                    <h3 class="mb-4">Create Your Account</h3>

                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstName" placeholder="First Name"
                                        required>
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lastName" placeholder="Last Name"
                                        required>
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="registerEmail" placeholder="Email Address"
                                required>
                            <label for="registerEmail">Email Address</label>
                        </div>

                        <div class="form-floating">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number" required>
                            <label for="phone">Phone Number</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="registerPassword" placeholder="Password"
                                required>
                            <label for="registerPassword">Password</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>

                        <div class="form-floating">
                            <select class="form-select" id="userType" required>
                                <option value="">Select User Type</option>
                                <option value="customer">Customer (Vehicle Owner)</option>
                                <option value="business">Business Owner (Mechanic/Dealer)</option>
                                <option value="technician">Technician</option>
                            </select>
                            <label for="userType">I am a...</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-auth">
                            <i class="fa fa-user-plus me-2"></i> Create Account
                        </button>
                    </form>

                    <div class="divider">
                        <span>OR SIGN UP WITH</span>
                    </div>

                    <div class="social-login">
                        <button class="btn-social">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button class="btn-social">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
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

    <script>
        function switchTab(tab) {
            // Update tabs
            const tabs = document.querySelectorAll('.auth-tab');
            tabs.forEach(t => t.classList.remove('active'));
            event.target.closest('.auth-tab').classList.add('active');

            // Update forms
            const forms = document.querySelectorAll('.auth-form');
            forms.forEach(f => f.classList.remove('active'));

            if (tab === 'login') {
                document.getElementById('loginForm').classList.add('active');
            } else {
                document.getElementById('registerForm').classList.add('active');
            }
        }

        function showForgotPassword() {
            alert('Password reset functionality will be implemented. Please contact support at info@quionltd.com');
        }

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (this.closest('#registerForm')) {
                    const password = document.getElementById('registerPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;

                    if (password !== confirmPassword) {
                        alert('Passwords do not match!');
                        return;
                    }

                    if (password.length < 8) {
                        alert('Password must be at least 8 characters long!');
                        return;
                    }

                    const agreeTerms = document.getElementById('agreeTerms').checked;
                    if (!agreeTerms) {
                        alert('Please agree to the Terms & Conditions!');
                        return;
                    }

                    alert('Registration successful! (This is a demo - backend integration required)');
                } else {
                    alert('Login successful! (This is a demo - backend integration required)');
                }
            });
        });

        // Social login handlers
        document.querySelectorAll('.btn-social').forEach(btn => {
            btn.addEventListener('click', function () {
                const provider = this.textContent.trim();
                alert(`${provider} login will be implemented with OAuth integration`);
            });
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>