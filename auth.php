<?php
require_once 'includes/config.php';

// Redirect if already logged in
if (is_logged_in()) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
$success = "";

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user['status'] === 'active') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];

                // Update last login
                $conn->query("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = " . $user['id']);

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Your account is " . $user['status'] . ". Please contact admin.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = sanitize_input($_POST['first_name'] . ' ' . $_POST['last_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = sanitize_input($_POST['user_type']);

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $check_query = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        if ($check_stmt->get_result()->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $status = 'active'; // Defaulting to active for now

            $insert_query = "INSERT INTO users (name, email, phone, password, status) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("sssss", $name, $email, $phone, $password_hash, $status);

            if ($insert_stmt->execute()) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
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
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i><?php echo $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

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

                    <form action="auth.php" method="POST">
                        <input type="hidden" name="login" value="1">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="loginEmail"
                                placeholder="Email Address" required>
                            <label for="loginEmail">Email Address</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="loginPassword"
                                placeholder="Password" required>
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

                    <form action="auth.php" method="POST">
                        <input type="hidden" name="register" value="1">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="first_name" class="form-control" id="firstName"
                                        placeholder="First Name" required>
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="last_name" class="form-control" id="lastName"
                                        placeholder="Last Name" required>
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="registerEmail"
                                placeholder="Email Address" required>
                            <label for="registerEmail">Email Address</label>
                        </div>

                        <div class="form-floating">
                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number"
                                required>
                            <label for="phone">Phone Number</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="registerPassword"
                                placeholder="Password" required>
                            <label for="registerPassword">Password</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" name="confirm_password" class="form-control" id="confirmPassword"
                                placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>

                        <div class="form-floating">
                            <select name="user_type" class="form-select" id="userType" required>
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