<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('products.index') }}" class="text-2xl font-bold text-blue-600">
                        ShopNow
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600">Products</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600">Categories</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Discover Amazing Products</h1>
                <p class="text-xl opacity-90">Find exactly what you're looking for with our powerful filters</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Search Bar -->
        <div class="mb-8 flex justify-center">
            @include('products.components.search')
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <aside class="lg:w-1/4">
                <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                    @include('products.components.filters')
                </form>
            </aside>

            <!-- Products Grid -->
            <section class="lg:w-3/4">
                <!-- Results Summary -->
                <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Products</h2>
                        <p class="text-gray-600">
                            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} products
                        </p>
                    </div>

                    @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-600">Active filters:</span>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @if(request('search'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                        Search: "{{ request('search') }}"
                                        <a href="{{ route('products.index', request()->except('search')) }}" class="ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if(request('category') && $selectedCategory = $categories->find(request('category')))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                        Category: {{ $selectedCategory->name }}
                                        <a href="{{ route('products.index', request()->except('category')) }}" class="ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if(request('price_min'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                                        Min: ${{ request('price_min') }}
                                        <a href="{{ route('products.index', request()->except('price_min')) }}" class="ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if(request('price_max'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800">
                                        Max: ${{ request('price_max') }}
                                        <a href="{{ route('products.index', request()->except('price_max')) }}" class="ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            @include('products.components.product-card', ['product' => $product])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">No products found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your search or filter to find what you're looking for.</p>
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition"
                        >
                            Clear All Filters
                        </a>
                    </div>
                @endif

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-12">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="text-2xl font-bold mb-2">ShopNow</div>
                    <p class="text-gray-400">Your one-stop shop for amazing products</p>
                </div>
                <div class="text-gray-400">
                    &copy; {{ date('Y') }} Product Catalog Search. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Auto-submit price range filters when both are filled
        document.addEventListener('DOMContentLoaded', function() {
            const priceMin = document.querySelector('input[name="price_min"]');
            const priceMax = document.querySelector('input[name="price_max"]');

            if (priceMin && priceMax) {
                priceMin.addEventListener('change', function() {
                    if (this.value && priceMax.value) {
                        document.getElementById('filterForm').submit();
                    }
                });

                priceMax.addEventListener('change', function() {
                    if (this.value && priceMin.value) {
                        document.getElementById('filterForm').submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
