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
        
        // Fetch products from the database
        $products = Product::all();

        $totalReviews = Review::count();

        // Se não houver avaliações, evita divisão por 0
        if($totalReviews > 0){
            $positiveReviews = Review::where("stars", ">=", "4")->count();
            $negativeReviews = Review::where("stars", "<=", "3")->count();

            $positiveReviewPercentage = round(($positiveReviews / $totalReviews) * 100, 1);
            $negativeReviewPercentage = round(($negativeReviews / $totalReviews) * 100, 1);
        }

        return view('dashboard', [
        'products' => $products,
        'positivePercentage' => $positiveReviewPercentage,
        'negativePercentage' => $negativeReviewPercentage,
    ]);
    }
}