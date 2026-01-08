<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Filters</h3>

    <!-- Category Filter -->
    <div class="mb-6">
        <h4 class="font-medium text-gray-700 mb-2">Category</h4>
        <div class="space-y-2">
            <label class="flex items-center">
                <input
                    type="radio"
                    name="category"
                    value=""
                    {{ !request('category') ? 'checked' : '' }}
                    onchange="this.form.submit()"
                    class="rounded-full text-blue-600 focus:ring-blue-500"
                >
                <span class="ml-2 text-gray-600">All Categories</span>
            </label>
            @foreach($categories as $category)
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="category"
                        value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'checked' : '' }}
                        onchange="this.form.submit()"
                        class="rounded-full text-blue-600 focus:ring-blue-500"
                    >
                    <span class="ml-2 text-gray-600">{{ $category->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Price Range Filter -->
    <div class="mb-6">
        <h4 class="font-medium text-gray-700 mb-2">Price Range</h4>
        <div class="flex space-x-4">
            <div class="flex-1">
                <label class="block text-sm text-gray-500 mb-1">Min</label>
                <input
                    type="number"
                    name="price_min"
                    value="{{ request('price_min') }}"
                    placeholder="0"
                    min="0"
                    step="0.01"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
            <div class="flex-1">
                <label class="block text-sm text-gray-500 mb-1">Max</label>
                <input
                    type="number"
                    name="price_max"
                    value="{{ request('price_max') }}"
                    placeholder="1000"
                    min="0"
                    step="0.01"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>
        <button
            type="submit"
            class="mt-3 w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
            Apply Price Filter
        </button>
    </div>

    <!-- Clear Filters -->
    @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
        <a
            href="{{ route('products.index') }}"
            class="block w-full text-center bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition"
        >
            Clear All Filters
        </a>
    @endif
</div>
