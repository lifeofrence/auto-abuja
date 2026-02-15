# Auto Abuja Business Directory - Implementation Plan

## Project Overview
A business directory listing website (similar to Jiji.ng) for automotive businesses in Abuja, integrated with VIO/EV Reg portal for user authentication.

## Design Requirements
- **Style**: Jiji.ng-inspired directory listing
- **Colors**: VIO colors (Black, White, minimal Yellow) from https://drts.gov.ng/
- **Features**: Multi-level categories/subcategories, Google Maps, searchable listings

## Completed Tasks ✅

### 1. Database Schema (`database/schema.sql`)
- ✅ Users table with VIO integration fields
- ✅ Categories and subcategories tables
- ✅ Businesses table with Google Maps coordinates
- ✅ Products/services table
- ✅ Advertisements table with expiry dates
- ✅ News table
- ✅ Reviews and ratings system
- ✅ User authorizations table (admin approval system)
- ✅ Activity logs
- ✅ Default data (admin user, categories, subcategories)

### 2. Configuration (`includes/config.php`)
- ✅ Database connection
- ✅ VIO API integration functions
- ✅ Helper functions (sanitization, authentication, file upload)
- ✅ Flash messages
- ✅ Activity logging

### 3. Listings Page (`listings.php`)
- ✅ Grid and map view toggle
- ✅ Category and subcategory filtering
- ✅ Search functionality
- ✅ Pagination
- ✅ Google Maps integration
- ✅ Business cards with ratings

## Remaining Tasks 📋

### Phase 1: Core Authentication & User Management

#### 1.1 Authentication System
**Files to create:**
- [ ] `auth-handler.php` - Process login/register/reset password
- [ ] Update `auth.php` - Integrate with VIO API for password reset

**Features:**
- [ ] Login with email from VIO portal
- [ ] Password reset using VIO credentials
- [ ] Session management
- [ ] Remember me functionality
- [ ] Account activation

#### 1.2 User Dashboard
**Files to create:**
- [ ] `user/dashboard.php` - User dashboard homepage
- [ ] `user/profile.php` - Edit profile
- [ ] `user/my-businesses.php` - List user's businesses
- [ ] `user/add-business.php` - Add new business listing
- [ ] `user/edit-business.php` - Edit existing business
- [ ] `user/my-products.php` - List user's products
- [ ] `user/add-product.php` - Add new product
- [ ] `user/edit-product.php` - Edit existing product

**Features:**
- [ ] Profile management (name, phone, address, photo)
- [ ] Business listing management
- [ ] Product/service management
- [ ] Upload multiple images
- [ ] Google Maps address picker
- [ ] View statistics (views, ratings)

### Phase 2: Admin Panel

#### 2.1 Admin Dashboard
**Files to create:**
- [ ] `admin/dashboard.php` - Admin homepage with statistics
- [ ] `admin/users.php` - Manage users
- [ ] `admin/businesses.php` - Approve/reject/edit businesses
- [ ] `admin/products.php` - Manage products
- [ ] `admin/categories.php` - Manage categories
- [ ] `admin/subcategories.php` - Manage subcategories
- [ ] `admin/authorizations.php` - Approve user category access
- [ ] `admin/advertisements.php` - Manage adverts
- [ ] `admin/news.php` - Manage news articles
- [ ] `admin/reviews.php` - Moderate reviews
- [ ] `admin/settings.php` - Site settings

**Features:**
- [ ] User management (enable/disable accounts)
- [ ] Business approval workflow
- [ ] Category authorization system
- [ ] Advertisement management with expiry dates
- [ ] News article management
- [ ] Review moderation
- [ ] Activity logs viewer
- [ ] Statistics and analytics

### Phase 3: Public Pages

#### 3.1 Business Pages
**Files to create:**
- [ ] `business-detail.php` - Single business page
- [ ] `business-contact.php` - Contact business form

**Features:**
- [ ] Full business details
- [ ] Google Maps location
- [ ] Photo gallery
- [ ] Products/services list
- [ ] Reviews and ratings
- [ ] Contact form
- [ ] Share buttons
- [ ] Related businesses

#### 3.2 News & Content
**Files to create:**
- [ ] `news.php` - News listing page
- [ ] `news-detail.php` - Single news article
- [ ] Update `index.php` - Add latest news section

**Features:**
- [ ] News listing with categories
- [ ] Featured news
- [ ] News search
- [ ] Related articles

#### 3.3 Update Existing Pages
**Files to update:**
- [ ] `index.php` - Add featured businesses, latest news
- [ ] `categories.php` - Link to actual listings
- [ ] `about.php` - Update content for directory (not company)
- [ ] `contact.php` - General contact form

### Phase 4: VIO API Integration

#### 4.1 API Endpoints
**Files to create:**
- [ ] `api/vio-sync.php` - Sync users from VIO portal
- [ ] `api/vio-auth.php` - Authenticate with VIO
- [ ] `api/vio-webhook.php` - Receive VIO updates

**Features:**
- [ ] Pull user data from VIO (email, name, phone)
- [ ] Verify user exists in VIO portal
- [ ] Password reset via VIO credentials
- [ ] Automatic user sync (cron job)

### Phase 5: Search & Filter Enhancement

#### 5.1 Advanced Search
**Files to create:**
- [ ] `search.php` - Global search page
- [ ] `api/search-autocomplete.php` - AJAX autocomplete

**Features:**
- [ ] Search businesses, products, news
- [ ] Autocomplete suggestions
- [ ] Filter by location, rating, category
- [ ] Sort by relevance, rating, date

### Phase 6: Additional Features

#### 6.1 Reviews & Ratings
**Files to create:**
- [ ] `api/submit-review.php` - Submit review
- [ ] `api/rate-business.php` - Rate business

**Features:**
- [ ] Submit reviews
- [ ] Rate businesses (1-5 stars)
- [ ] Admin moderation
- [ ] Review responses

#### 6.2 Advertisements
**Features:**
- [ ] Display ads on homepage
- [ ] Display ads on category pages
- [ ] Display ads on business detail pages
- [ ] Track ad clicks and views
- [ ] Auto-expire ads based on end date

#### 6.3 Email Notifications
**Files to create:**
- [ ] `includes/email-templates.php` - Email templates
- [ ] `includes/mailer.php` - Email sending functions

**Features:**
- [ ] Welcome email
- [ ] Password reset email
- [ ] Business approval/rejection email
- [ ] New review notification
- [ ] Authorization approval email

### Phase 7: UI/UX Enhancements

#### 7.1 Design Updates
**Files to update:**
- [ ] `css/style.css` - Update to VIO colors (black, white, yellow)
- [ ] `includes/header.php` - Add user menu, search bar
- [ ] `includes/footer.php` - Update footer content

**Features:**
- [ ] VIO color scheme (black #FFB400, white #FFFFFF, yellow #FFB400)
- [ ] Jiji-style cards and layouts
- [ ] Responsive design
- [ ] Loading animations
- [ ] Toast notifications

#### 7.2 Mobile Optimization
- [ ] Responsive navigation
- [ ] Mobile-friendly forms
- [ ] Touch-optimized maps
- [ ] Mobile image optimization

### Phase 8: Testing & Deployment

#### 8.1 Testing
- [ ] User registration and login
- [ ] Business listing creation
- [ ] Admin approval workflow
- [ ] Search and filtering
- [ ] Google Maps integration
- [ ] Image uploads
- [ ] Email notifications
- [ ] Mobile responsiveness

#### 8.2 Deployment
- [ ] Set up production database
- [ ] Configure VIO API credentials
- [ ] Configure Google Maps API key
- [ ] Set up email server
- [ ] Configure file upload permissions
- [ ] Set up SSL certificate
- [ ] Create backup system
- [ ] Set up monitoring

## Database Setup Instructions

1. Create database:
```sql
CREATE DATABASE auto_abuja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Import schema:
```bash
mysql -u root -p auto_abuja < database/schema.sql
```

3. Update `includes/config.php` with your database credentials

4. Default admin login:
   - Email: admin@autoabuja.com
   - Password: admin123 (CHANGE THIS!)

## API Keys Required

1. **VIO API**
   - Endpoint: Update `VIO_API_URL` in config.php
   - API Key: Update `VIO_API_KEY` in config.php

2. **Google Maps API**
   - Get key from: https://console.cloud.google.com/
   - Enable: Maps JavaScript API, Geocoding API
   - Update `GOOGLE_MAPS_API_KEY` in config.php

## File Structure

```
auto-abuja/
├── admin/                  # Admin panel pages
├── api/                    # API endpoints
├── css/                    # Stylesheets
├── database/              # Database schema
├── img/                   # Images
├── includes/              # PHP includes
│   ├── config.php        # Configuration
│   ├── header.php        # Header
│   └── footer.php        # Footer
├── js/                    # JavaScript files
├── lib/                   # Third-party libraries
├── uploads/               # User uploaded files
│   ├── businesses/       # Business images
│   ├── products/         # Product images
│   ├── users/            # User profile images
│   ├── news/             # News images
│   └── ads/              # Advertisement images
├── user/                  # User dashboard pages
├── auth.php              # Authentication page
├── auth-handler.php      # Authentication handler
├── business-detail.php   # Business detail page
├── categories.php        # Categories page
├── index.php             # Homepage
├── listings.php          # Listings page
├── news.php              # News listing
├── news-detail.php       # News detail
└── search.php            # Search page
```

## Priority Order

### Immediate (Week 1)
1. ✅ Database schema
2. ✅ Configuration file
3. ✅ Listings page
4. Authentication system
5. User dashboard (add/edit business)

### Short-term (Week 2)
6. Admin panel (user management, business approval)
7. Business detail page
8. VIO API integration
9. Update design to VIO colors

### Medium-term (Week 3-4)
10. News system
11. Reviews and ratings
12. Advertisement system
13. Email notifications
14. Advanced search

### Long-term (Week 5+)
15. Mobile optimization
16. Performance optimization
17. Analytics and reporting
18. Testing and bug fixes
19. Deployment

## Notes

- The website is a **directory listing platform**, not a company website
- Users register on VIO portal first, then can access this portal
- Admin must authorize users to list under specific categories/subcategories
- Use sample Google Maps addresses (can repeat 3 addresses for demo)
- Focus on Jiji.ng-style user experience
- Emphasize black, white, and minimal yellow color scheme
