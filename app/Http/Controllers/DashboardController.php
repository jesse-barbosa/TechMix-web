<?php

namespace App\Http\Controllers;

// Para Logs
use Illuminate\Support\Facades\Log;

use App\Models\Product;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch products from the database for the logged-in store
        $products = Product::where('storeId', auth()->id())->get();

        // Get the product IDs for the logged-in store
        $productIds = $products->pluck('id');

        // Fetch reviews count for the products of the logged-in store
        $totalReviews = Review::whereIn('productId', $productIds)->count();

        // Se não houver avaliações, evita divisão por 0
        if($totalReviews > 0){
            $positiveReviews = Review::whereIn('productId', $productIds)
                                     ->where("stars", ">=", "4")
                                     ->count();
            $negativeReviews = Review::whereIn('productId', $productIds)
                                     ->where("stars", "<=", "3")
                                     ->count();

            $positiveReviewPercentage = round(($positiveReviews / $totalReviews) * 100, 1);
            $negativeReviewPercentage = round(($negativeReviews / $totalReviews) * 100, 1);
        }

        return view('dashboard', [
            'products' => $products,
            'positivePercentage' => $positiveReviewPercentage ?? 0,
            'negativePercentage' => $negativeReviewPercentage ?? 0,
        ]);
    }
}