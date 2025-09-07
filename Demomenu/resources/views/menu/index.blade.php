<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الطعام - مطعم فلوريتا سوشي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .category-item {
            transition: all 0.3s ease;
        }
        .category-item.active {
            background: #dc2626;
            color: white;
        }
        .product-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: none;
        }
        .product-card:hover {
            transform: translateY(-2px);
        }
        .calories-badge {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            transition: all 0.3s ease;
        }
        .calories-badge:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #ff5252, #ff7979);
        }
        .floating-nav {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            z-index: 50;
        }
        @media (min-width: 1024px) {
            .floating-nav {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white sticky top-0 z-40">
        <div class="container mx-auto px-4 py-6">
            <!-- Desktop Header -->
            <div class="hidden lg:flex items-start justify-between">
                <div class="flex flex-col">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2 text-right">مطعم فلوريتا سوشي</h1>
                    <p class="text-gray-600 text-right mb-1">مرحباً بكم</p>
                    <p class="text-red-600 text-sm text-right">تذوق أجمل النكهات اليابانية الأصيلة</p>
                </div>
                
                <!-- Desktop Search -->
                <div class="flex-1 max-w-md mx-8">
                    <form method="GET" action="{{ route('menu.index') }}" class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ $search }}"
                               placeholder="ابحث عن منتج..." 
                               class="w-full px-4 py-3 pl-14 rounded-full border-0 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400">
                        <button type="submit" 
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-red-600 text-white w-10 h-10 rounded-full hover:bg-red-700 transition-colors flex items-center justify-center">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                    </form>
                </div>
                
                <nav class="flex space-x-reverse space-x-6">
                    <a href="#" class="text-gray-600 hover:text-red-600 transition-colors">القائمة الرئيسية</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 transition-colors">العروض الخاصة</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 transition-colors">تواصل معنا</a>
                </nav>
            </div>

            <!-- Mobile Header -->
            <div class="lg:hidden pt-8">
                <h1 class="text-3xl font-bold text-gray-800 text-right mb-4">مطعم فلوريتا سوشي</h1>
                <p class="text-lg text-gray-600 text-right mb-2">مرحباً بكم</p>
                <p class="text-red-600 text-base text-right mb-6">تذوق أجمل النكهات اليابانية الأصيلة</p>
                
                <!-- Mobile Search -->
                <form method="GET" action="{{ route('menu.index') }}" class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="ابحث عن منتج..." 
                           class="w-full px-4 py-3 pl-14 rounded-full border-0 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400">
                    <button type="submit" 
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-red-600 text-white w-10 h-10 rounded-full hover:bg-red-700 transition-colors flex items-center justify-center">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories Slider -->
    <div class="bg-white py-4 sticky top-32 lg:top-32 z-30">
        <div class="container mx-auto px-4">
            <div class="flex overflow-x-auto hide-scrollbar space-x-reverse space-x-4 pb-2">
                <!-- All Categories -->
                <button class="category-item {{ $selectedCategoryId == 'all' ? 'active' : 'bg-gray-100 text-gray-700' }} px-6 py-3 rounded-full whitespace-nowrap font-medium min-w-max"
                        onclick="loadProducts('all')">
                    الكل
                </button>
                
                @foreach($categories as $category)
                <button class="category-item {{ $selectedCategoryId == $category->id ? 'active' : 'bg-gray-100 text-gray-700' }} px-6 py-3 rounded-full whitespace-nowrap font-medium min-w-max"
                        onclick="loadProducts('{{ $category->id }}')">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto px-4 py-6 pb-24 lg:pb-6">
        <div id="products-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-2xl overflow-hidden">
                <div class="relative">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover rounded-2xl">
                    
                    @if($product->discount_percentage > 0)
                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                        -{{ $product->discount_percentage }}%
                    </div>
                    @endif
                    
                    @if($product->is_featured)
                    <div class="absolute top-3 left-3 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm">
                        <i class="fas fa-star"></i>
                    </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $product->name }}</h3>
                    
                    @if($product->description)
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                    @endif
                    
                    <!-- السعرات الحرارية -->
                    <div class="inline-flex items-center bg-gradient-to-r from-red-400 to-red-500 text-white px-3 py-1 rounded-full text-xs mb-3 calories-badge cursor-pointer">
                        <i class="fas fa-fire ml-1"></i>
                        <span>{{ $product->calories ?? rand(150, 500) }} سعرة حرارية</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-reverse space-x-2">
                            <span class="text-lg font-bold text-red-600">{{ number_format($product->price, 2) }} ر.س</span>
                            
                            @if($product->original_price && $product->original_price > $product->price)
                            <span class="text-sm text-gray-500 line-through">{{ number_format($product->original_price, 2) }} ر.س</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($products->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-600 mb-2">لا توجد منتجات</h3>
            <p class="text-gray-500">جرب البحث بكلمة مختلفة أو اختر تصنيف آخر</p>
        </div>
        @endif
    </div>

    <!-- Floating Navigation (Mobile Only) -->
    <div class="floating-nav lg:hidden">
        <div class="glass-effect rounded-2xl px-6 py-4 shadow-xl">
            <div class="flex items-center justify-around">
                <a href="#" class="flex flex-col items-center text-red-600 hover:text-red-800 transition-colors">
                    <i class="fas fa-utensils text-xl mb-1"></i>
                    <span class="text-xs">المنيو</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-600 hover:text-red-600 transition-colors">
                    <i class="fas fa-percent text-xl mb-1"></i>
                    <span class="text-xs">العروض</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-600 hover:text-red-600 transition-colors">
                    <i class="fas fa-phone text-xl mb-1"></i>
                    <span class="text-xs">تواصل</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-reverse space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
            <span class="text-gray-700">جاري التحميل...</span>
        </div>
    </div>

    <script>
        let currentCategory = '{{ $selectedCategoryId }}';

        function loadProducts(categoryId) {
            if (categoryId === currentCategory) return;
            
            currentCategory = categoryId;
            
            // Update active category button
            document.querySelectorAll('.category-item').forEach(btn => {
                btn.classList.remove('active', 'bg-purple-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            
            event.target.classList.remove('bg-gray-100', 'text-gray-700');
            event.target.classList.add('active');
            
            // Show loading
            document.getElementById('loading-overlay').classList.remove('hidden');
            
            // Fetch products
            fetch(`/api/products/category/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    renderProducts(data.products);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في تحميل المنتجات');
                })
                .finally(() => {
                    document.getElementById('loading-overlay').classList.add('hidden');
                });
        }

        function renderProducts(products) {
            const container = document.getElementById('products-container');
            
            if (products.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-600 mb-2">لا توجد منتجات</h3>
                        <p class="text-gray-500">لا توجد منتجات في هذا التصنيف</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = products.map(product => `
                <div class="product-card bg-white rounded-2xl overflow-hidden">
                    <div class="relative">
                        <img src="${product.image || 'https://via.placeholder.com/300x200'}" 
                             alt="${product.name}" 
                             class="w-full h-48 object-cover rounded-2xl">
                        
                        ${product.discount_percentage > 0 ? `
                        <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                            -${product.discount_percentage}%
                        </div>
                        ` : ''}
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">${product.name}</h3>
                        
                        ${product.description ? `
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">${product.description}</p>
                        ` : ''}
                        
                        <!-- السعرات الحرارية -->
                        <div class="inline-flex items-center bg-gradient-to-r from-red-400 to-red-500 text-white px-3 py-1 rounded-full text-xs mb-3 calories-badge cursor-pointer">
                            <i class="fas fa-fire ml-1"></i>
                            <span>${product.calories || Math.floor(Math.random() * 351) + 150} سعرة حرارية</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-reverse space-x-2">
                                <span class="text-lg font-bold text-red-600">${parseFloat(product.price).toFixed(2)} ر.س</span>
                                
                                ${product.original_price && product.original_price > product.price ? `
                                <span class="text-sm text-gray-500 line-through">${parseFloat(product.original_price).toFixed(2)} ر.س</span>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Smooth scroll for category selection
        document.addEventListener('DOMContentLoaded', function() {
            const activeCategory = document.querySelector('.category-item.active');
            if (activeCategory) {
                activeCategory.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        });
    </script>
</body>
</html>
