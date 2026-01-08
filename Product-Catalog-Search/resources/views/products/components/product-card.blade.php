<div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">
    <!-- Product Image -->
    <div class="h-48 bg-gray-200 relative">
        @if($product->image)
            <img
                src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover"
            >
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        <div class="absolute top-3 left-3">
            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                {{ $product->category->name }}
            </span>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">
            {{ $product->name }}
        </h3>
        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
            {{ $product->description }}
        </p>

        <div class="flex items-center justify-between">
            <div>
                <span class="text-xl font-bold text-gray-900">
                    ${{ number_format($product->price, 2) }}
                </span>
            </div>
            <div class="flex items-center space-x-2">
                @if($product->stock > 0)
                    <span class="text-green-600 text-sm font-medium">
                        In Stock ({{ $product->stock }})
                    </span>
                @else
                    <span class="text-red-600 text-sm font-medium">
                        Out of Stock
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
