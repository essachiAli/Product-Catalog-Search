<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

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

        return view('products.index', compact('products', 'categories'));
    }
}
