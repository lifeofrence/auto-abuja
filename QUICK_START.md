# Quick Start Guide - Auto Abuja Directory

## 🚀 Get Started in 5 Minutes

### Step 1: Set Up Database (2 minutes)

Open your terminal and run:

```bash
# Login to MySQL
mysql -u root -p

# Create database and import schema
CREATE DATABASE auto_abuja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE auto_abuja;
SOURCE /Users/lifeofrence/Downloads/auto-abuja/database/schema.sql;
EXIT;
```

✅ **What this does:**
- Creates the database
- Creates all 10 tables
- Inserts 6 categories
- Inserts 15 subcategories
- Creates default admin user

### Step 2: Configure the Application (1 minute)

Edit `includes/config.php` and update these lines:

```php
// Line 11-14: Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');              // Your MySQL username
define('DB_PASS', '');                  // Your MySQL password
define('DB_NAME', 'auto_abuja');

// Line 27: Google Maps API Key (get from https://console.cloud.google.com/)
define('GOOGLE_MAPS_API_KEY', 'YOUR_API_KEY_HERE');
```

### Step 3: Create Uploads Directory (30 seconds)

```bash
cd /Users/lifeofrence/Downloads/auto-abuja
mkdir -p uploads/{businesses,products,users,news,ads}
chmod -R 755 uploads/
```

### Step 4: Test the Installation (1 minute)

Open your browser and visit:

```
http://localhost/auto-abuja/
```

You should see:
- ✅ Homepage loads
- ✅ Categories page works
- ✅ Listings page works (may be empty)

### Step 5: Login as Admin (30 seconds)

Visit: `http://localhost/auto-abuja/auth.php`

**Default Credentials:**
- Email: `admin@autoabuja.com`
- Password: `admin123`

⚠️ **IMPORTANT**: Change this password immediately!

---

## 📋 What You Have Now

### ✅ Working Features

1. **Database Structure**
   - All tables created
   - Sample categories and subcategories
   - Admin user ready

2. **Listings Page** (`listings.php`)
   - Search businesses
   - Filter by category
   - Filter by subcategory
   - Grid view
   - Map view (needs Google Maps API key)
   - Pagination

3. **Categories Page** (`categories.php`)
   - Shows all 6 categories
   - Shows subcategories for each
   - Links to filtered listings

4. **Configuration System**
   - Database connection
   - Helper functions
   - VIO API integration (ready for credentials)
   - File upload system
   - Activity logging

### 🔨 What Needs to Be Built

#### Priority 1: Authentication (Required to use the platform)
- [ ] Login functionality
- [ ] Registration (syncs with VIO)
- [ ] Password reset
- [ ] Session management

#### Priority 2: User Dashboard (Required for business owners)
- [ ] Add business listing form
- [ ] Edit business listing
- [ ] Add products/services
- [ ] Upload images
- [ ] View statistics

#### Priority 3: Admin Panel (Required for management)
- [ ] Approve/reject businesses
- [ ] Manage users (enable/disable)
- [ ] Authorize category access
- [ ] Manage advertisements
- [ ] Manage news

---

## 🎯 Next Steps

### Option A: Build Authentication First (Recommended)

This allows users to actually use the platform:

1. Create `auth-handler.php` to process login/register
2. Update `auth.php` to connect to VIO API
3. Create session management
4. Add "My Account" dropdown to header

**Time Estimate**: 2-3 hours

### Option B: Build User Dashboard First

This allows business owners to add listings:

1. Create `user/dashboard.php`
2. Create `user/add-business.php` with form
3. Create `user/edit-business.php`
4. Add image upload functionality

**Time Estimate**: 3-4 hours

### Option C: Build Admin Panel First

This allows you to manage the platform:

1. Create `admin/dashboard.php` with statistics
2. Create `admin/businesses.php` to approve listings
3. Create `admin/users.php` to manage users
4. Create `admin/authorizations.php`

**Time Estimate**: 4-5 hours

---

## 🧪 Testing Your Setup

### Test 1: Database Connection

Create a test file `test-db.php`:

```php
<?php
require_once 'includes/config.php';

echo "Database Connection: ";
if ($conn) {
    echo "✅ SUCCESS<br>";
    
    // Count categories
    $result = $conn->query("SELECT COUNT(*) as count FROM categories");
    $count = $result->fetch_assoc()['count'];
    echo "Categories in database: $count<br>";
    
    // Count subcategories
    $result = $conn->query("SELECT COUNT(*) as count FROM subcategories");
    $count = $result->fetch_assoc()['count'];
    echo "Subcategories in database: $count<br>";
} else {
    echo "❌ FAILED<br>";
}
?>
```

Visit: `http://localhost/auto-abuja/test-db.php`

Expected output:
```
Database Connection: ✅ SUCCESS
Categories in database: 6
Subcategories in database: 15
```

### Test 2: Listings Page

Visit: `http://localhost/auto-abuja/listings.php`

You should see:
- Search bar
- Category filter
- Subcategory filter
- "0 Businesses Found" (because no businesses added yet)

### Test 3: Categories Page

Visit: `http://localhost/auto-abuja/categories.php`

You should see:
- 6 category cards
- Each with subcategories listed
- "View All" buttons

---

## 🎨 Customization Guide

### Change Site Name

Edit `includes/header.php` line 44:

```php
<h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>Your Site Name</h2>
```

### Change Contact Information

Edit `includes/header.php` lines 17, 21, 27:

```php
<small>Your Address</small>
<small>Your Hours</small>
<small>Your Phone</small>
```

### Add Your Logo

Replace the text logo with an image in `includes/header.php`:

```php
<a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
    <img src="img/logo.png" alt="Auto Abuja" height="50">
</a>
```

### Update Colors to VIO Theme

Edit `css/style.css` and replace:

```css
/* Current primary color */
.text-primary { color: #06A3DA !important; }
.bg-primary { background-color: #06A3DA !important; }

/* Change to VIO colors */
.text-primary { color: #FFB400 !important; }
.bg-primary { background-color: #FFB400 !important; }
.btn-primary { background-color: #FFB400; border-color: #FFB400; }
.btn-primary:hover { background-color: #FFB400; border-color: #FFB400; color: #FFB400; }
```

---

## 📊 Adding Sample Data

### Add a Sample Business (via MySQL)

```sql
USE auto_abuja;

-- Insert a test business
INSERT INTO businesses (
    user_id, category_id, subcategory_id, 
    business_name, slug, description, 
    address, latitude, longitude, 
    phone, email, status
) VALUES (
    1, 1, 1,
    'Premium Auto Workshop',
    'premium-auto-workshop',
    'Full-service auto repair and maintenance workshop with certified technicians',
    'Plot 123, Adetokunbo Ademola Crescent, Wuse 2, Abuja',
    9.0579, 7.4951,
    '08012345678',
    'info@premiumauto.com',
    'approved'
);
```

Now visit `listings.php?category=mechanics&sub=grade-a` to see your test business!

### Add Sample Products

```sql
-- Insert products for the business
INSERT INTO products (
    business_id, user_id, name, slug, 
    description, price, price_type, is_available
) VALUES 
(1, 1, 'Oil Change Service', 'oil-change-service', 
 'Complete oil change with filter replacement', 5000.00, 'fixed', TRUE),
(1, 1, 'Brake Pad Replacement', 'brake-pad-replacement', 
 'Front and rear brake pad replacement', 15000.00, 'fixed', TRUE),
(1, 1, 'Engine Diagnostics', 'engine-diagnostics', 
 'Comprehensive engine diagnostic service', 8000.00, 'fixed', TRUE);
```

---

## 🆘 Troubleshooting

### Problem: "Database connection error"

**Solution:**
1. Check MySQL is running: `mysql.server status`
2. Verify credentials in `includes/config.php`
3. Ensure database exists: `SHOW DATABASES;`

### Problem: "Page not found" errors

**Solution:**
1. Check you're accessing the correct URL
2. Verify file exists in the directory
3. Check file permissions: `chmod 644 *.php`

### Problem: "Map not showing"

**Solution:**
1. Add Google Maps API key in `includes/config.php`
2. Enable Maps JavaScript API in Google Cloud Console
3. Check browser console for errors

### Problem: "Images not uploading"

**Solution:**
1. Create uploads directory: `mkdir -p uploads`
2. Set permissions: `chmod -R 755 uploads/`
3. Check PHP upload settings in `php.ini`

---

## 📚 Useful Commands

### View Database Tables
```bash
mysql -u root -p auto_abuja -e "SHOW TABLES;"
```

### Count Records
```bash
mysql -u root -p auto_abuja -e "
SELECT 'Categories' as Table_Name, COUNT(*) as Count FROM categories
UNION ALL
SELECT 'Subcategories', COUNT(*) FROM subcategories
UNION ALL
SELECT 'Businesses', COUNT(*) FROM businesses
UNION ALL
SELECT 'Users', COUNT(*) FROM users;
"
```

### Backup Database
```bash
mysqldump -u root -p auto_abuja > backup_$(date +%Y%m%d).sql
```

### Restore Database
```bash
mysql -u root -p auto_abuja < backup_20260215.sql
```

---

## 🎓 Learning Resources

### PHP & MySQL
- [PHP Manual](https://www.php.net/manual/en/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [W3Schools PHP Tutorial](https://www.w3schools.com/php/)

### Google Maps API
- [Maps JavaScript API](https://developers.google.com/maps/documentation/javascript)
- [Geocoding API](https://developers.google.com/maps/documentation/geocoding)

### Bootstrap 5
- [Bootstrap Documentation](https://getbootstrap.com/docs/5.0/)
- [Bootstrap Examples](https://getbootstrap.com/docs/5.0/examples/)

---

## ✅ Checklist

Before going live, ensure:

- [ ] Database is set up correctly
- [ ] Configuration file is updated
- [ ] Uploads directory exists with correct permissions
- [ ] Default admin password is changed
- [ ] Google Maps API key is added
- [ ] VIO API credentials are configured
- [ ] SSL certificate is installed
- [ ] Backup system is in place
- [ ] Error logging is enabled
- [ ] All test data is removed

---

**Need Help?**

Check the detailed documentation:
- `README.md` - Full project documentation
- `IMPLEMENTATION_PLAN.md` - Development roadmap
- `PROJECT_SUMMARY.md` - Project overview

**Ready to build?** Start with the authentication system! 🚀
