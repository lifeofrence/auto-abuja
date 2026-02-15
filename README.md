# Auto Abuja Business Directory

> A comprehensive business directory platform for automotive services in Abuja, integrated with VIO/EV Reg portal.

## 🎯 Project Overview

**Auto Abuja** is a business directory listing website (similar to Jiji.ng) that connects vehicle owners with trusted automotive service providers across Abuja. This is NOT a company website - it's a platform where different businesses can list their services.

### Key Concept
```
Jiji Model:    Nigeria → Abuja → Product Listings
Auto Abuja:    Categories → Subcategories → Business Listings
```

## 🚀 Features

### ✅ Implemented
- **Comprehensive Database Schema** with 10+ tables
- **Category/Subcategory System** (6 categories, 15 subcategories)
- **Business Listings Page** with grid and map views
- **Advanced Search & Filtering**
- **Google Maps Integration**
- **Pagination System**
- **Rating & Review System** (database ready)
- **Advertisement Management** (database ready)
- **News System** (database ready)
- **VIO API Integration** (helper functions ready)

### 📋 Pending
- Authentication system (login/register/password reset)
- User dashboard (add/edit businesses and products)
- Admin panel (approve businesses, manage users)
- Business detail pages
- News listing and detail pages
- Email notifications
- VIO API actual connection

## 📁 Project Structure

```
auto-abuja/
├── database/
│   └── schema.sql              # Complete database schema
├── includes/
│   ├── config.php              # Configuration & helper functions
│   ├── header.php              # Site header
│   └── footer.php              # Site footer
├── admin/                      # (To be created) Admin panel
├── user/                       # (To be created) User dashboard
├── api/                        # (To be created) API endpoints
├── uploads/                    # (To be created) User uploads
├── listings.php                # Business listings page
├── categories.php              # Categories overview
├── index.php                   # Homepage
├── auth.php                    # Authentication page
├── IMPLEMENTATION_PLAN.md      # Detailed roadmap
├── PROJECT_SUMMARY.md          # Project documentation
└── README.md                   # This file
```

## 🗄️ Database Schema

### Main Tables
1. **users** - User accounts with VIO integration
2. **categories** - Main business categories
3. **subcategories** - Category subdivisions
4. **businesses** - Business listings
5. **products** - Products/services offered
6. **advertisements** - Ad management with expiry
7. **news** - News articles
8. **reviews** - Business reviews and ratings
9. **user_authorizations** - Admin approval system
10. **activity_logs** - System activity tracking

### Categories & Subcategories

#### 1. Auto Mechanics & Technicians
- Grade A - Standardized Workshops
- Grade B - Regular Mechanics
- Grade C - Petty Mechanics

#### 2. Automobile Dealerships
- New Vehicle Dealers
- Used Vehicles (Tokunbo)
- Local Used Vehicles

#### 3. Auto Spare Parts
- Heavy Duty Parts
- Light Duty Parts
- Accessories

#### 4. Tow Truck Operators
- Emergency Towing
- Heavy Duty Towing

#### 5. Auto Dismantlers & Recyclers
- Vehicle Dismantlers
- Parts Recycling

#### 6. Service Stations
- Fuel Stations
- Quick Service Centers

## 🔧 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Google Maps API key
- VIO API credentials (when available)

### Step 1: Database Setup

```bash
# Create database
mysql -u root -p
```

```sql
CREATE DATABASE auto_abuja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE auto_abuja;
SOURCE database/schema.sql;
EXIT;
```

### Step 2: Configuration

Edit `includes/config.php`:

```php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'auto_abuja');

// Google Maps API Key
define('GOOGLE_MAPS_API_KEY', 'your_google_maps_api_key');

// VIO API Configuration
define('VIO_API_URL', 'https://drts.gov.ng/api');
define('VIO_API_KEY', 'your_vio_api_key');
```

### Step 3: File Permissions

```bash
# Create uploads directory
mkdir -p uploads/{businesses,products,users,news,ads}

# Set permissions
chmod -R 755 uploads/
```

### Step 4: Access the Site

```
http://localhost/auto-abuja/
```

### Default Admin Login
- **Email**: admin@autoabuja.com
- **Password**: admin123
- ⚠️ **CHANGE THIS IMMEDIATELY!**

## 🎨 Design Guidelines

### Color Scheme (VIO Colors)
```css
Primary Black:   #FFB400
Primary White:   #FFFFFF
Accent Yellow:   #FFB400 (use sparingly)
Text Dark:       #2C2C2C
Text Light:      #666666
Border:          #E0E0E0
Background:      #F8F9FA
```

### Design Reference
- **VIO Website**: https://drts.gov.ng/
- **Style Inspiration**: Jiji.ng directory layout
- **Approach**: Clean, modern, easy to navigate

## 🔐 User Flow

### For Business Owners
1. Register on **VIO/EV Reg portal** (external system)
2. API syncs user data (email, name, phone) to Auto Abuja
3. Reset password on Auto Abuja using VIO credentials
4. Request authorization to list under specific category/subcategory
5. **Admin approves** authorization request
6. User logs in and creates business listing
7. Admin approves business listing
8. Business goes live on the platform

### For Public Users
1. Visit Auto Abuja website
2. Browse categories or search for businesses
3. Filter by category, subcategory, location
4. View business details, location on map
5. Contact business directly (phone, email, WhatsApp)
6. Leave reviews and ratings

## 📱 Key Pages

### Public Pages
- **Homepage** (`index.php`) - Featured businesses, categories, news
- **Categories** (`categories.php`) - Browse all categories
- **Listings** (`listings.php`) - Search and filter businesses
- **Business Detail** (To be created) - Full business information
- **News** (To be created) - Latest automotive news

### User Pages (To be created)
- **Dashboard** - Overview of user's businesses
- **My Businesses** - Manage business listings
- **My Products** - Manage products/services
- **Profile** - Edit user profile

### Admin Pages (To be created)
- **Dashboard** - Statistics and overview
- **Users** - Manage user accounts
- **Businesses** - Approve/reject listings
- **Authorizations** - Approve category access
- **Advertisements** - Manage ads
- **News** - Manage news articles
- **Reviews** - Moderate reviews

## 🗺️ Google Maps Integration

### Sample Addresses for Testing

```php
// Wuse 2, Abuja
$address1 = "Plot 123, Adetokunbo Ademola Crescent, Wuse 2, Abuja";
$lat1 = 9.0579;
$lng1 = 7.4951;

// Garki, Abuja
$address2 = "45 Tafawa Balewa Way, Garki, Abuja";
$lat2 = 9.0354;
$lng2 = 7.4870;

// Maitama, Abuja
$address3 = "12 Aguiyi Ironsi Street, Maitama, Abuja";
$lat3 = 9.0820;
$lng3 = 7.5050;
```

## 🔌 VIO API Integration

### Expected API Endpoints

```php
// Get user by email
GET /api/users/by-email?email={email}

// Authenticate user
POST /api/auth/login
{
    "email": "user@example.com",
    "password": "password"
}

// Reset password
POST /api/auth/reset-password
{
    "email": "user@example.com",
    "token": "reset_token"
}
```

### Integration Points
1. **User Registration** - Pull user data from VIO
2. **Password Reset** - Verify against VIO credentials
3. **User Sync** - Periodic sync of user information
4. **Webhooks** - Receive updates from VIO portal

## 📊 Admin Responsibilities

### Daily Tasks
- Review and approve new business listings
- Moderate user reviews
- Respond to user inquiries

### Weekly Tasks
- Approve user authorization requests
- Update news articles
- Review advertisement performance

### Monthly Tasks
- Generate usage reports
- Review and renew advertisements
- Database backup
- Security audit

## 🔒 Security Features

- Password hashing (bcrypt)
- SQL injection prevention
- XSS protection
- CSRF tokens (to be implemented)
- File upload validation
- Activity logging
- Admin-only access controls

## 📈 Future Enhancements

### Phase 1 (Immediate)
- [ ] Complete authentication system
- [ ] Build user dashboard
- [ ] Build admin panel
- [ ] Create business detail pages

### Phase 2 (Short-term)
- [ ] Email notifications
- [ ] Advanced search with autocomplete
- [ ] Mobile app (PWA)
- [ ] SMS notifications

### Phase 3 (Long-term)
- [ ] Business analytics dashboard
- [ ] Premium listings
- [ ] Featured advertisements
- [ ] Multi-language support
- [ ] Payment integration

## 🐛 Known Issues

- Authentication system not yet implemented
- VIO API integration pending actual credentials
- Some pages still reference "our service" (needs update)
- Google Maps API key needs to be added

## 📝 Development Notes

### Important Reminders
- This is a **directory platform**, not a company website
- Avoid using "our service", "we offer", etc.
- Use "Find businesses", "Browse listings", "Connect with providers"
- Users MUST register on VIO portal first
- Admin approval required for category access
- All businesses need Google Maps coordinates

### Code Standards
- Use prepared statements for database queries
- Sanitize all user inputs
- Log important actions
- Use meaningful variable names
- Comment complex logic
- Follow PSR-12 coding standards

## 🤝 Contributing

### Development Workflow
1. Create feature branch
2. Implement feature
3. Test thoroughly
4. Submit for review
5. Merge to main

### Testing Checklist
- [ ] Database operations work correctly
- [ ] Forms validate properly
- [ ] Images upload successfully
- [ ] Maps display correctly
- [ ] Search returns accurate results
- [ ] Pagination works
- [ ] Mobile responsive
- [ ] Cross-browser compatible

## 📞 Support

### Technical Issues
- Check `activity_logs` table for errors
- Review PHP error logs
- Verify database connections
- Check file permissions

### Business Inquiries
- Email: admin@autoabuja.com
- Phone: (+234) 803 787 9981

## 📄 License

Copyright © 2026 Quion Nigeria Limited  
Designed by Jubilee Systems Ltd

## 🙏 Acknowledgments

- VIO/EV Reg Portal for user data integration
- Google Maps for location services
- Bootstrap for responsive framework
- Font Awesome for icons

---

**Version**: 1.0.0 (Foundation)  
**Status**: In Development  
**Last Updated**: February 15, 2026

**Next Steps**: Build authentication system and user dashboard
