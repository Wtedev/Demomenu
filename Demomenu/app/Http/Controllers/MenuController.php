<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->ordered()->with('activeProducts')->get();
        
        $selectedCategoryId = $request->get('category', 'all');
        $search = $request->get('search');

        $query = Product::available()->with('category');

        if ($selectedCategoryId !== 'all') {
            $query->where('category_id', $selectedCategoryId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->ordered()->get();

        return view('menu.index', compact('categories', 'products', 'selectedCategoryId', 'search'));
    }

    public function getProductsByCategory(Request $request, $categoryId)
    {
        $query = Product::available()->with('category');

        if ($categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        $products = $query->ordered()->get();

        return response()->json([
            'products' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'original_price' => $product->original_price,
                    'calories' => $product->calories,
                    'image' => $product->image,
                    'discount_percentage' => $product->discount_percentage,
                    'category' => $product->category->name
                ];
            })
        ]);
    }
}
