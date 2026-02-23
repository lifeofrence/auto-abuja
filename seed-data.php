<?php
/**
 * Database Seeder - Auto Abuja Business Directory
 * This script populates the database with realistic sample data.
 */

require_once 'includes/config.php';

// Check if run from command line or with a special parameter to prevent accidental runs
if (php_sapi_name() !== 'cli' && (!isset($_GET['run']) || $_GET['run'] !== 'true')) {
    die("To run this script via browser, add ?run=true to the URL. Or run via CLI: php seed-data.php");
}

echo "Starting database seeding...\n";

// 0. SEED CATEGORIES & SUBCATEGORIES (If missing)
$categories = [
    ['name' => 'Auto Mechanics & Technicians', 'slug' => 'mechanics', 'desc' => 'Find certified mechanics and workshops', 'icon' => 'fa-wrench'],
    ['name' => 'Automobile Dealerships', 'slug' => 'dealers', 'desc' => 'Reliable car dealers and showrooms', 'icon' => 'fa-car'],
    ['name' => 'Auto Spare Parts', 'slug' => 'spare-parts', 'desc' => 'Genuine spare parts', 'icon' => 'fa-cogs'],
    ['name' => 'Tow Truck Operators', 'slug' => 'towing', 'desc' => '24/7 towing services', 'icon' => 'fa-truck-pickup'],
];

foreach ($categories as $cat) {
    $slug = $cat['slug'];
    $check = $conn->query("SELECT id FROM categories WHERE slug = '$slug'");
    if ($check->num_rows == 0) {
        $name = $cat['name'];
        $desc = $cat['desc'];
        $icon = $cat['icon'];
        $conn->query("INSERT INTO categories (name, slug, description, icon) VALUES ('$name', '$slug', '$desc', '$icon')");
    }
}
echo "Categories checked/seeded.\n";

$subcategories = [
    ['cat' => 'mechanics', 'name' => 'Grade A - Standardized Workshops', 'slug' => 'grade-a'],
    ['cat' => 'dealers', 'name' => 'Used Vehicles (Tokunbo)', 'slug' => 'tokunbo'],
    ['cat' => 'spare-parts', 'name' => 'Light Duty Parts', 'slug' => 'light-duty'],
    ['cat' => 'towing', 'name' => 'Emergency Towing', 'slug' => 'emergency'],
];

foreach ($subcategories as $sub) {
    $cat_slug = $sub['cat'];
    $sub_slug = $sub['slug'];
    $res = $conn->query("SELECT id FROM categories WHERE slug = '$cat_slug'");
    $cat_id = $res->fetch_assoc()['id'];

    $check = $conn->query("SELECT id FROM subcategories WHERE slug = '$sub_slug' AND category_id = $cat_id");
    if ($check->num_rows == 0) {
        $name = $sub['name'];
        $conn->query("INSERT INTO subcategories (category_id, name, slug) VALUES ($cat_id, '$name', '$sub_slug')");
    }
}
echo "Subcategories checked/seeded.\n";

// 1. SEED USERS
$users_data = [
    ['email' => 'tech@autoabuja.com', 'name' => 'Musa Mechanics', 'phone' => '08022221111', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user', 'status' => 'active'],
    ['email' => 'sales@abuja-autos.com', 'name' => 'Abuja Auto Sales', 'phone' => '08033332222', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user', 'status' => 'active'],
    ['email' => 'john@towing.com', 'name' => 'John Towing Services', 'phone' => '08044443333', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user', 'status' => 'active'],
    ['email' => 'spareparts@kado.com', 'name' => 'Kado Parts World', 'phone' => '08055554444', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user', 'status' => 'active'],
    ['email' => 'user@example.com', 'name' => 'Abuja Car Owner', 'phone' => '08066665555', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user', 'status' => 'active'],
];

foreach ($users_data as $u) {
    $email = $u['email'];
    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check->num_rows == 0) {
        $name = $u['name'];
        $phone = $u['phone'];
        $pass = $u['password'];
        $role = $u['role'];
        $status = $u['status'];
        // Use 'password' column name as found in debug-schema.php
        $conn->query("INSERT INTO users (email, name, phone, password, role, status) VALUES ('$email', '$name', '$phone', '$pass', '$role', '$status')");
    }
}
echo "Users seeded.\n";

// Get user IDs
$res = $conn->query("SELECT id FROM users WHERE email = 'tech@autoabuja.com'");
$user_tech = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM users WHERE email = 'sales@abuja-autos.com'");
$user_sales = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM users WHERE email = 'john@towing.com'");
$user_towing = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM users WHERE email = 'spareparts@kado.com'");
$user_spare = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM users WHERE email = 'user@example.com'");
$user_customer = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1");
$admin_row = $res->fetch_assoc();
$admin_id = $admin_row ? $admin_row['id'] : 1; // Fallback to 1 if no admin found

// Get Category IDs
$res = $conn->query("SELECT id FROM categories WHERE slug = 'mechanics'");
$cat_mechanics = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM categories WHERE slug = 'dealers'");
$cat_dealers = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM categories WHERE slug = 'spare-parts'");
$cat_spare = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM categories WHERE slug = 'towing'");
$cat_towing = $res->fetch_assoc()['id'];

// Get Subcategory IDs
$res = $conn->query("SELECT id FROM subcategories WHERE slug = 'grade-a'");
$sub_grade_a = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM subcategories WHERE slug = 'tokunbo'");
$sub_tokunbo = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM subcategories WHERE slug = 'light-duty'");
$sub_light_duty = $res->fetch_assoc()['id'];
$res = $conn->query("SELECT id FROM subcategories WHERE slug = 'emergency'");
$sub_towing_emergency = $res->fetch_assoc()['id'];


// 3. SEED BUSINESSES
$businesses_data = [
    [
        'user_id' => $user_tech,
        'category_id' => $cat_mechanics,
        'subcategory_id' => $sub_grade_a,
        'name' => 'Musa Advanced Technicians',
        'slug' => 'musa-advanced-technicians',
        'desc' => 'Modern auto-repair center specializing in German and Japanese vehicles. We use computerized diagnostics.',
        'addr' => 'Plot 44, Garki II Industrial Area, Abuja',
        'lat' => 9.0333,
        'lng' => 7.4833,
        'phone' => '08022221111',
        'email' => 'info@musatech.com',
        'status' => 'approved',
        'featured' => 1
    ],
    [
        'user_id' => $user_sales,
        'category_id' => $cat_dealers,
        'subcategory_id' => $sub_tokunbo,
        'name' => 'Unity Car Showroom',
        'slug' => 'unity-car-showroom',
        'desc' => 'The best Tokyo-imported vehicles in Abuja. Verified mileage and clean titles always.',
        'addr' => 'Beside Banex Plaza, Wuse 2, Abuja',
        'lat' => 9.0770,
        'lng' => 7.4797,
        'phone' => '08033332222',
        'email' => 'sales@unitycars.com',
        'status' => 'approved',
        'featured' => 1
    ],
    [
        'user_id' => $user_spare,
        'category_id' => $cat_spare,
        'subcategory_id' => $sub_light_duty,
        'name' => 'Kado Genuine Parts',
        'slug' => 'kado-genuine-parts',
        'desc' => 'Wholesale and retail of genuine Toyota, Honda, and Nissan spare parts.',
        'addr' => 'Shop 22, Kado Spare Parts Market, Abuja',
        'lat' => 9.0722,
        'lng' => 7.4233,
        'phone' => '08055554444',
        'email' => 'parts@kadoworld.com',
        'status' => 'approved',
        'featured' => 0
    ],
    [
        'user_id' => $user_towing,
        'category_id' => $cat_towing,
        'subcategory_id' => $sub_towing_emergency,
        'name' => 'Abuja Rapid Response Towing',
        'slug' => 'abuja-rapid-response-towing',
        'desc' => '24/7 emergency roadside assistance and towing across Abuja and FCT environs.',
        'addr' => 'Opposite Total Filling Station, Berger, Abuja',
        'lat' => 9.0620,
        'lng' => 7.4640,
        'phone' => '08044443333',
        'email' => 'help@abujatowing.com',
        'status' => 'approved',
        'featured' => 0
    ],
];

foreach ($businesses_data as $b) {
    $slug = $b['slug'];
    $check = $conn->query("SELECT id FROM businesses WHERE slug = '$slug'");
    if ($check->num_rows == 0) {
        $uid = $b['user_id'];
        $cid = $b['category_id'];
        $sid = $b['subcategory_id'];
        $name = $b['name'];
        $desc = $b['desc'];
        $addr = $b['addr'];
        $lat = $b['lat'];
        $lng = $b['lng'];
        $phone = $b['phone'];
        $email = $b['email'];
        $status = $b['status'];
        $feat = $b['featured'];

        $conn->query("INSERT INTO businesses (user_id, category_id, subcategory_id, business_name, slug, description, address, latitude, longitude, phone, email, status, is_featured) 
                     VALUES ($uid, $cid, $sid, '$name', '$slug', '$desc', '$addr', $lat, $lng, '$phone', '$email', '$status', $feat)");
    }
}
echo "Businesses seeded.\n";

// 4. SEED PRODUCTS
$res = $conn->query("SELECT id, user_id FROM businesses");
while ($row = $res->fetch_assoc()) {
    $bid = $row['id'];
    $uid = $row['user_id'];
    $b_res = $conn->query("SELECT business_name FROM businesses WHERE id = $bid");
    $b_name = $b_res->fetch_assoc()['business_name'];

    $products = [];
    if (strpos($b_name, 'Technicians') !== false) {
        $products = [
            ['name' => 'Full Engine Overhaul', 'price' => 150000],
            ['name' => 'Computerized Diagnostic Scan', 'price' => 10000],
            ['name' => 'Suspension Refurbishing', 'price' => 45000],
        ];
    } elseif (strpos($b_name, 'Showroom') !== false) {
        $products = [
            ['name' => '2015 Toyota Camry (Tokunbo)', 'price' => 7500000],
            ['name' => '2018 Honda Accord (Tokunbo)', 'price' => 9800000],
            ['name' => '2014 Lexus RX350', 'price' => 12500000],
        ];
    } elseif (strpos($b_name, 'Parts') !== false) {
        $products = [
            ['name' => 'Toyota Brake Pads (Set)', 'price' => 12000],
            ['name' => 'Premium Oil Filter', 'price' => 3500],
            ['name' => 'Denso Spark Plugs (4pcs)', 'price' => 18000],
        ];
    } elseif (strpos($b_name, 'Towing') !== false) {
        $products = [
            ['name' => 'City Towing (Within Wuse/Garki)', 'price' => 15000],
            ['name' => 'Out of City Towing (to Gwagwalada)', 'price' => 35000],
            ['name' => 'Jump Start Service', 'price' => 5000],
        ];
    }

    foreach ($products as $p) {
        $pname = $p['name'];
        $pslug = generate_slug($pname);
        $pprice = $p['price'];
        $check = $conn->query("SELECT id FROM products WHERE business_id = $bid AND slug = '$pslug'");
        if ($check->num_rows == 0) {
            $conn->query("INSERT INTO products (business_id, user_id, name, slug, price, price_type, is_available) 
                         VALUES ($bid, $uid, '$pname', '$pslug', $pprice, 'fixed', 1)");
        }
    }
}
echo "Products seeded.\n";

// 5. SEED NEWS
$news_data = [
    [
        'title' => 'VIO Abuja Begins New Inspection Standards',
        'slug' => 'vio-abuja-new-standards',
        'content' => 'The Directorate of Road Traffic Services (DRTS) in Abuja has announced a new set of inspection standards for commercial vehicles operating within the FCT. This initiative aims to reduce road accidents caused by mechanical failure. All vehicle owners are advised to ensure their vehicles meet the Grade A standards before the enforcement begins next month.',
        'category' => 'Regulation',
        'author' => $admin_id
    ],
    [
        'title' => 'Top 5 Reliable Tokunbo Cars for Abuja Roads',
        'slug' => 'top-5-reliable-cars-abuja',
        'content' => 'Driving in Abuja can be demanding. Between the smooth highways and the occasional heavy traffic in Nyanya or Kubwa, you need a car that is both fuel-efficient and durable. Our top 5 includes the Toyota Corolla, Honda Civic, and more.',
        'category' => 'Tips',
        'author' => $admin_id
    ],
    [
        'title' => 'How to Spot Fake Spare Parts in Kado Market',
        'slug' => 'spotting-fake-spare-parts',
        'content' => 'Fake spare parts are a major cause of recurring vehicle break-downs. Our experts have put together a guide on how to identify genuine parts in local markets, focusing on holograms, packaging, and specific serial number checks.',
        'category' => 'Maintenance',
        'author' => $admin_id
    ]
];

foreach ($news_data as $n) {
    $slug = $n['slug'];
    $check = $conn->query("SELECT id FROM news WHERE slug = '$slug'");
    if ($check->num_rows == 0) {
        $title = $n['title'];
        $content = $n['content'];
        $cat = $n['category'];
        $aid = $n['author'];
        $excerpt = substr($content, 0, 150) . '...';
        $conn->query("INSERT INTO news (title, slug, excerpt, content, category, author_id, status, is_featured, published_at) 
                     VALUES ('$title', '$slug', '$excerpt', '$content', '$cat', $aid, 'published', 1, CURRENT_TIMESTAMP)");
    }
}
echo "News seeded.\n";

// 6. SEED ADVERTISEMENTS
$ads_data = [
    [
        'title' => 'Premium Car Wash',
        'image' => 'img/ads/carwash.jpg',
        'pos' => 'sidebar',
        'url' => '#'
    ],
    [
        'title' => 'Subscribe to VIO Updates',
        'image' => 'img/ads/vio.jpg',
        'pos' => 'homepage_middle',
        'url' => 'https://drts.gov.ng'
    ],
    [
        'title' => 'Specialized Tuning Service',
        'image' => 'img/ads/tuning.jpg',
        'pos' => 'header',
        'url' => '#'
    ]
];

foreach ($ads_data as $ad) {
    $title = $ad['title'];
    $check = $conn->query("SELECT id FROM advertisements WHERE title = '$title'");
    if ($check->num_rows == 0) {
        $img = $ad['image'];
        $pos = $ad['pos'];
        $url = $ad['url'];
        $start = date('Y-m-d');
        $end = date('Y-m-d', strtotime('+3 months'));
        $conn->query("INSERT INTO advertisements (title, image, link_url, position, start_date, end_date, is_active, created_by) 
                     VALUES ('$title', '$img', '$url', '$pos', '$start', '$end', 1, $admin_id)");
    }
}
echo "Advertisements seeded.\n";

// 7. SEED REVIEWS
$res = $conn->query("SELECT id FROM businesses");
while ($row = $res->fetch_assoc()) {
    $bid = $row['id'];
    $check = $conn->query("SELECT id FROM reviews WHERE business_id = $bid AND user_id = $user_customer");
    if ($check->num_rows == 0) {
        $rating = rand(4, 5);
        $review = "Great service! Very professional and highly recommended for anyone in Abuja.";
        $conn->query("INSERT INTO reviews (business_id, user_id, rating, review_text, status) 
                     VALUES ($bid, $user_customer, $rating, '$review', 'approved')");

        // Update business rating cache
        $conn->query("UPDATE businesses SET rating_average = $rating, rating_count = rating_count + 1 WHERE id = $bid");
    }
}
echo "Reviews seeded.\n";

echo "Database seeding completed successfully!\n";
?>