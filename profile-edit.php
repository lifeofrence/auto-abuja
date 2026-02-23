<?php
require_once 'includes/config.php';

// Check if user is logged in
require_login();

$user_id = $_SESSION['user_id'];
$user = get_user_data($user_id);
$error = "";
$success = "";

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = sanitize_input($_POST['name']);
    $phone = sanitize_input($_POST['phone']);
    $address = sanitize_input($_POST['address']);

    // Handle image upload
    $profile_image = $user['profile_image'];
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploaded_path = upload_image($_FILES['profile_image'], 'profiles');
        if ($uploaded_path) {
            $profile_image = $uploaded_path;
        }
    }

    $update_query = "UPDATE users SET name = ?, phone = ?, address = ?, profile_image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $name, $phone, $address, $profile_image, $user_id);

    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
        $_SESSION['name'] = $name; // Update session name
        $user = get_user_data($user_id); // Refresh user data
    } else {
        $error = "Failed to update profile. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Profile - A.R.T.S.P</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'includes/header.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0 text-dark">Edit Profile Settings</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if ($error): ?>
                            <div class="alert alert-danger mb-4">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success mb-4">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>

                        <form action="profile-edit.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_profile" value="1">

                            <div class="text-center mb-4">
                                <img src="<?php echo $user['profile_image'] ?: 'img/testimonial-1.jpg'; ?>"
                                    id="profilePreview"
                                    class="rounded-circle mb-3 border border-4 border-light shadow-sm"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <div class="mt-2">
                                    <label for="profileImage" class="btn btn-sm btn-outline-primary">Change
                                        Photo</label>
                                    <input type="file" name="profile_image" id="profileImage" class="d-none"
                                        accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control py-2"
                                        value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email Address (Cannot change)</label>
                                    <input type="email" class="form-control py-2 bg-light"
                                        value="<?php echo htmlspecialchars($user['email']); ?>" readonly disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control py-2"
                                        value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Home/Business Address</label>
                                    <textarea name="address" class="form-control py-2"
                                        rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 fw-bold py-2">Save Changes</button>
                                <a href="dashboard.php" class="btn btn-outline-dark px-4 py-2">Back to Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profilePreview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>