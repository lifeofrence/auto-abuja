<?php
/**
 * Database Configuration
 * Auto Abuja Business Directory
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'auto_abuja');

// Site Configuration
define('SITE_NAME', 'Auto Abuja Directory');
define('SITE_URL', 'http://localhost/auto-abuja');
define('ADMIN_EMAIL', 'admin@autoabuja.com');

// VIO API Configuration
define('VIO_API_URL', 'https://drts.gov.ng/api'); // Replace with actual API endpoint
define('VIO_API_KEY', 'your_api_key_here'); // Replace with actual API key

// File Upload Configuration
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']);

// Pagination
define('ITEMS_PER_PAGE', 12);

// Google Maps API Key
define('GOOGLE_MAPS_API_KEY', 'your_google_maps_api_key_here'); // Replace with actual key

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    die("Database connection error. Please contact the administrator.");
}

/**
 * Helper Functions
 */

// Sanitize input
function sanitize_input($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

// Check if user is logged in
function is_logged_in()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Check if user is admin
function is_admin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Redirect if not logged in
function require_login()
{
    if (!is_logged_in()) {
        header('Location: ' . SITE_URL . '/auth.php');
        exit();
    }
}

// Redirect if not admin
function require_admin()
{
    if (!is_admin()) {
        header('Location: ' . SITE_URL . '/index.php');
        exit();
    }
}

// Generate slug from string
function generate_slug($string)
{
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

// Format date
function format_date($date)
{
    return date('M d, Y', strtotime($date));
}

// Format datetime
function format_datetime($datetime)
{
    return date('M d, Y h:i A', strtotime($datetime));
}

// Time ago function
function time_ago($datetime)
{
    $timestamp = strtotime($datetime);
    $difference = time() - $timestamp;

    if ($difference < 60) {
        return 'Just now';
    } elseif ($difference < 3600) {
        $mins = floor($difference / 60);
        return $mins . ' minute' . ($mins > 1 ? 's' : '') . ' ago';
    } elseif ($difference < 86400) {
        $hours = floor($difference / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($difference < 604800) {
        $days = floor($difference / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return format_date($datetime);
    }
}

// Upload image
function upload_image($file, $directory = 'general')
{
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Check file size
    if ($file['size'] > MAX_FILE_SIZE) {
        return false;
    }

    // Check file type
    if (!in_array($file['type'], ALLOWED_IMAGE_TYPES)) {
        return false;
    }

    // Create directory if it doesn't exist
    $upload_path = UPLOAD_DIR . $directory . '/';
    if (!file_exists($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $filepath = $upload_path . $filename;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return 'uploads/' . $directory . '/' . $filename;
    }

    return false;
}

// Delete image
function delete_image($filepath)
{
    if (file_exists($filepath)) {
        return unlink($filepath);
    }
    return false;
}

// Get user data
function get_user_data($user_id)
{
    global $conn;
    $user_id = (int) $user_id;
    $query = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

// Log activity
function log_activity($user_id, $action, $entity_type = null, $entity_id = null, $description = null)
{
    global $conn;

    $user_id = $user_id ? (int) $user_id : 'NULL';
    $action = sanitize_input($action);
    $entity_type = $entity_type ? "'" . sanitize_input($entity_type) . "'" : 'NULL';
    $entity_id = $entity_id ? (int) $entity_id : 'NULL';
    $description = $description ? "'" . sanitize_input($description) . "'" : 'NULL';
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $query = "INSERT INTO activity_logs (user_id, action, entity_type, entity_id, description, ip_address, user_agent) 
              VALUES ($user_id, '$action', $entity_type, $entity_id, $description, '$ip_address', '$user_agent')";

    return $conn->query($query);
}

// Send email (basic function - can be enhanced with PHPMailer)
function send_email($to, $subject, $message)
{
    $headers = "From: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($to, $subject, $message, $headers);
}

// Flash message functions
function set_flash_message($message, $type = 'success')
{
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function get_flash_message()
{
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'success';
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

// VIO API Integration Functions
function vio_api_request($endpoint, $method = 'GET', $data = [])
{
    $url = VIO_API_URL . $endpoint;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . VIO_API_KEY,
        'Content-Type: application/json'
    ]);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        return json_decode($response, true);
    }

    return false;
}

function sync_user_from_vio($email)
{
    // Call VIO API to get user data
    $vio_user = vio_api_request('/users/by-email?email=' . urlencode($email));

    if ($vio_user && isset($vio_user['data'])) {
        global $conn;
        $user_data = $vio_user['data'];

        // Check if user exists
        $email_safe = sanitize_input($email);
        $check_query = "SELECT id FROM users WHERE email = '$email_safe' LIMIT 1";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Update existing user
            $user = $result->fetch_assoc();
            $name = sanitize_input($user_data['name']);
            $phone = sanitize_input($user_data['phone']);
            $vio_id = sanitize_input($user_data['id']);

            $update_query = "UPDATE users SET 
                            name = '$name', 
                            phone = '$phone', 
                            vio_user_id = '$vio_id' 
                            WHERE email = '$email_safe'";
            $conn->query($update_query);

            return $user['id'];
        } else {
            // Create new user
            $name = sanitize_input($user_data['name']);
            $phone = sanitize_input($user_data['phone']);
            $vio_id = sanitize_input($user_data['id']);

            $insert_query = "INSERT INTO users (email, name, phone, vio_user_id, status) 
                            VALUES ('$email_safe', '$name', '$phone', '$vio_id', 'pending')";

            if ($conn->query($insert_query)) {
                return $conn->insert_id;
            }
        }
    }

    return false;
}
