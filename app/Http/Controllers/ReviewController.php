<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        // Fetch reviews with related users and products
        $reviews = Review::with(['user', 'product'])->get();
    
        // Pass the reviews to the view
        return view('avaliacoes', ['reviews' => $reviews]);
    }

}