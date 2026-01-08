<div class="w-full max-w-xl">
    <form action="{{ route('products.index') }}" method="GET" class="relative">
        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search products..."
        class="w-full px-4 py-3 pl-12 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition">

        <div class="absolute left-4 top-3.5 text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            @if(request('search'))
            <a href="{{ route('products.index', request()->except('search')) }}"
                class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            @endif
        </div>
    </form>
</div>
