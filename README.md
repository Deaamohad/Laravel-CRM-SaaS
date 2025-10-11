# 🚀 Cliento - Modern CRM SaaS Platform

> A full-featured Customer Relationship Management system built with Laravel 12, featuring a clean dashboard, company management, deal tracking, and comprehensive API integration.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.0-38B2AC.svg)
![Vite](https://img.shields.io/badge/Vite-7.0-646CFF.svg)

## ✨ What I Built

This is a complete CRM (Customer Relationship Management) SaaS application that I developed from scratch. It's designed to help businesses manage their customer relationships, track sales deals, and monitor interactions - all through a modern, intuitive interface.

### 🎯 Key Features

- **📊 Smart Dashboard** - Real-time analytics and insights with revenue tracking
- **🏢 Company Management** - Complete CRUD operations for client companies
- **💰 Deal Pipeline** - Track sales deals from initial contact to closing
- **📞 Interaction Logging** - Record and manage all customer touchpoints
- **🔐 Secure Authentication** - Laravel Sanctum for API token management
- **📱 Responsive Design** - Works perfectly on desktop and mobile
- **🔌 RESTful API** - Full API integration for third-party applications
- **⚙️ User Settings** - Profile management and account customization

## 🛠️ Tech Stack

**Backend:**
- Laravel 12 (Latest version)
- PHP 8.2+
- MySQL/SQLite database
- Laravel Sanctum for API authentication
- Eloquent ORM for database management

**Frontend:**
- TailwindCSS 4.0 for styling
- Alpine.js for interactive components
- Vite for asset bundling
- Responsive design principles

**Development Tools:**
- Pest for testing
- Laravel Pint for code formatting
- Faker for database seeding
- Concurrent development setup

## 🚀 Getting Started

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or SQLite

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/laravel-crm-saas.git
   cd laravel-crm-saas
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets and start development**
   ```bash
   npm run dev
   php artisan serve
   ```

The application will be available at `http://localhost:8000`

## 📱 Screenshots

*[Add screenshots of your dashboard, company management, and deal tracking pages here]*

## 🔧 API Documentation

The application includes a comprehensive REST API:

### Authentication
- `POST /api/login` - User authentication
- `POST /api/logout` - User logout
- `GET /api/user` - Get current user info

### Companies
- `GET /api/companies` - List all companies
- `POST /api/companies` - Create new company
- `GET /api/companies/{id}` - Get company details
- `PUT /api/companies/{id}` - Update company
- `DELETE /api/companies/{id}` - Delete company

### Deals
- `GET /api/deals` - List all deals
- `POST /api/deals` - Create new deal
- `GET /api/deals/{id}` - Get deal details

### Analytics
- `GET /api/stats` - Get dashboard statistics
- `GET /api/recent-activities` - Get recent activities

## 🏗️ Project Structure

```
app/
├── Http/Controllers/     # API and web controllers
├── Models/              # Eloquent models (User, Company, Deal, Interaction)
├── Services/            # Business logic services
└── Rules/               # Custom validation rules

resources/
├── views/               # Blade templates
│   ├── dashboard/       # Dashboard views
│   ├── companies/       # Company management
│   ├── deals/          # Deal tracking
│   └── layouts/        # Layout templates
└── css/                # TailwindCSS styles

database/
├── migrations/          # Database schema
├── seeders/            # Sample data
└── factories/          # Model factories for testing
```

## 🎨 Design Decisions

- **Laravel 12**: Chose the latest Laravel version for modern PHP features and performance
- **TailwindCSS**: For rapid, consistent UI development
- **Alpine.js**: Lightweight JavaScript framework for interactivity
- **Laravel Sanctum**: Simple API authentication without the complexity of OAuth
- **Eloquent Relationships**: Properly structured database relationships for data integrity

## 🔒 Security Features

- CSRF protection on all forms
- SQL injection prevention through Eloquent ORM
- XSS protection with Blade templating
- Secure password hashing
- API token authentication
- Input validation and sanitization

## 📈 Performance Optimizations

- Eager loading to prevent N+1 queries
- Database indexing on foreign keys
- Optimized asset bundling with Vite
- Efficient pagination for large datasets
- Caching strategies for frequently accessed data

## 📝 License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT)
