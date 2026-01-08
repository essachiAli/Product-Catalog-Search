# Product Catalog Search - E-commerce Project

A complete Laravel + TailwindCSS e-commerce product catalog with advanced search, filtering, and pagination features.

![Product Catalog](https://img.shields.io/badge/Product-Catalog-blue) ![Laravel](https://img.shields.io/badge/Laravel-9.x-red) ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC) ![License](https://img.shields.io/badge/License-MIT-green)

## 📋 Table of Contents
- [Features](#-features)
- [Demo](#-demo)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [Key Code Examples](#-key-code-examples)
- [Screenshots](#-screenshots)
- [API Reference](#-api-reference)
- [Learning Outcomes](#-learning-outcomes)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

### 🔍 Search & Filtering
- **Smart Search**: Real-time product search by name with partial matching
- **Category Filter**: Filter products by category with radio button selection
- **Price Range**: Filter by minimum and maximum price
- **Active Filters**: Visual display of applied filters with easy removal

### 🎨 UI/UX Features
- **Responsive Design**: Fully responsive across all device sizes
- **Modern Interface**: Clean, intuitive interface with TailwindCSS
- **Product Cards**: Beautiful product cards with images, prices, and stock status
- **Pagination**: Elegant pagination with query string preservation
- **Empty States**: User-friendly empty states when no products match filters

### ⚙️ Technical Features
- **Eloquent Query Building**: Clean, efficient database queries
- **Conditional Filtering**: Smart `when()` queries for dynamic filtering
- **Model Relationships**: Proper Laravel Eloquent relationships
- **Blade Components**: Modular, reusable view components
- **Form Handling**: Proper form submissions with GET requests

## 🚀 Demo

### Quick Start
```bash
# Clone and run the demo
git clone <repository-url>
cd product-catalog
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

**Live Demo URL**: `http://localhost:8000`

## 🛠 Tech Stack

**Backend:**
- Laravel 9.x/10.x
- PHP 8.1+
- MySQL/PostgreSQL/SQLite

**Frontend:**
- TailwindCSS 3.x
- Font Awesome Icons
- Vanilla JavaScript

**Development:**
- Composer
- Node.js/NPM
- Laravel Sail (Optional)

## 📦 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js 16+ and NPM
- MySQL/PostgreSQL database

### Step-by-Step Setup

1. **Clone the repository:**
```bash
git clone https://github.com/yourusername/product-catalog.git
cd product-catalog
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Install JavaScript dependencies:**
```bash
npm install
```

4. **Configure environment:**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Update database configuration in `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_catalog
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations and seed data:**
```bash
php artisan migrate --seed
```

7. **Build assets and start server:**
```bash
# Development
npm run dev
php artisan serve

# Production
npm run build
```

8. **Access the application:**
Open your browser and navigate to `http://localhost:8000`

### Docker Setup (Alternative)
```bash
# Using Laravel Sail
composer require laravel/sail --dev
php artisan sail:install
./vendor/bin/sail up -d
./vendor/bin/sail npm run dev
```

## 📁 Project Structure

```
product-catalog/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProductController.php  # Main controller
│   └── Models/
│       ├── Product.php                # Product model with scopes
│       └── Category.php               # Category model
├── database/
│   ├── migrations/                    # Database migrations
│   │   ├── create_categories_table.php
│   │   └── create_products_table.php
│   └── seeders/
│       └── DatabaseSeeder.php         # Sample data
├── resources/
│   └── views/
│       └── products/
│           ├── index.blade.php        # Main view
│           └── components/            # Reusable components
│               ├── search.blade.php   # Search component
│               ├── filters.blade.php  # Filters component
│               └── product-card.blade.php
├── routes/
│   └── web.php                        # Application routes
└── tailwind.config.js                 # Tailwind configuration
```

## 💡 Key Code Examples

### 1. Elegant Query Building (ProductController.php)
```php
public function index(Request $request)
{
    $products = Product::query()
        ->with('category')
        ->active()
        ->when($request->search, fn($q) => 
            $q->where('name', 'LIKE', "%{$request->search}%")
        )
        ->when($request->category, fn($q) => 
            $q->where('category_id', $request->category)
        )
        ->when($request->price_min, fn($q) => 
            $q->where('price', '>=', $request->price_min)
        )
        ->when($request->price_max, fn($q) => 
            $q->where('price', '<=', $request->price_max)
        )
        ->orderBy('created_at', 'desc')
        ->paginate(12);
}
```

### 2. Model Scopes (Product.php)
```php
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

public function scopeInStock($query)
{
    return $query->where('stock', '>', 0);
}
```

### 3. Blade Component Usage
```blade
<!-- Search Component -->
@include('products.components.search')

<!-- Filters Component -->
@include('products.components.filters', ['categories' => $categories])

<!-- Product Grid -->
@foreach($products as $product)
    @include('products.components.product-card', ['product' => $product])
@endforeach
```

### 4. Dynamic Filter Display
```blade
@if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
    <div class="flex flex-wrap gap-2 mt-1">
        @if(request('search'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                Search: "{{ request('search') }}"
                <a href="{{ route('products.index', request()->except('search')) }}" class="ml-2">
                    <i class="fas fa-times"></i>
                </a>
            </span>
        @endif
    </div>
@endif
```

## 📸 Screenshots

### Desktop View
```
┌─────────────────────────────────────────────────────┐
│                    ShopNow                          │
├─────────────────────────────────────────────────────┤
│  [🔍 Search products...]                            │
│                                                    │
│  ┌─────────────┐  ┌──────────────────────────────┐  │
│  │  FILTERS    │  │  PRODUCT GRID (3 cols)       │  │
│  │  • All Cats │  │  ┌────┐ ┌────┐ ┌────┐       │  │
│  │  • Category │  │  │    │ │    │ │    │       │  │
│  │  • Price    │  │  │    │ │    │ │    │       │  │
│  │    Min [   ]│  │  └────┘ └────┘ └────┘       │  │
│  │    Max [   ]│  │                              │  │
│  └─────────────┘  └──────────────────────────────┘  │
└─────────────────────────────────────────────────────┘
```

### Mobile View
```
┌─────────────────────────────────────┐
│              ShopNow                │
├─────────────────────────────────────┤
│ [🔍 Search...]                      │
│                                     │
│ ┌─────────────────────────────────┐ │
│ │        FILTERS (Dropdown)       │ │
│ └─────────────────────────────────┘ │
│                                     │
│ ┌────┐ ┌────┐                       │
│ │    │ │    │                       │
│ └────┘ └────┘                       │
│                                     │
│ [1] [2] [3] [Next]                  │
└─────────────────────────────────────┘
```

## 📚 API Reference

### Routes
| Method | URL | Action | Description |
|--------|-----|--------|-------------|
| GET | `/` | ProductController@index | Main product listing with filters |

### Query Parameters
| Parameter | Type | Description | Example |
|-----------|------|-------------|---------|
| `search` | string | Search product names | `?search=laptop` |
| `category` | integer | Filter by category ID | `?category=1` |
| `price_min` | decimal | Minimum price filter | `?price_min=50` |
| `price_max` | decimal | Maximum price filter | `?price_max=500` |
| `page` | integer | Pagination page | `?page=2` |

## 🎯 Learning Outcomes

### Core Laravel Skills
1. **Eloquent Query Building**: Master the `when()` method for conditional queries
2. **Controller Design**: Clean, single-responsibility controllers
3. **Blade Templating**: Component-based view architecture
4. **Database Design**: Proper migrations and model relationships

### Advanced Techniques
- **Conditional Filtering**: Dynamic query building based on user input
- **Pagination with Query Strings**: Preserving filters across pages
- **Form Handling**: GET requests for filter applications
- **Model Scopes**: Reusable query constraints

### Frontend Skills
- **TailwindCSS Utility Classes**: Rapid UI development
- **Responsive Design**: Mobile-first approach
- **JavaScript Integration**: Lightweight interactivity
- **Component Architecture**: Reusable Blade components

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. **Fork the repository**
2. **Create a feature branch:**
```bash
git checkout -b feature/amazing-feature
```
3. **Commit your changes:**
```bash
git commit -m 'Add amazing feature'
```
4. **Push to the branch:**
```bash
git push origin feature/amazing-feature
```
5. **Open a Pull Request**

### Development Guidelines
- Follow PSR-12 coding standards
- Write clear commit messages
- Add tests for new features
- Update documentation as needed

### Feature Ideas
- [ ] Add product sorting options
- [ ] Implement shopping cart functionality
- [ ] Add user authentication
- [ ] Create admin panel
- [ ] Add product reviews and ratings
- [ ] Implement wishlist feature
- [ ] Add advanced filtering (brand, color, size)
- [ ] Create REST API endpoints

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel Documentation](https://laravel.com/docs)
- [TailwindCSS Documentation](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com)

## 📞 Support

For support, email essachi.service@gmail.com or create an issue in the GitHub repository.

---

<div align="center">
  <sub>Built with ❤️ using Laravel & TailwindCSS</sub>
  <br>
  <sub>If you find this project helpful, please give it a ⭐!</sub>
</div>