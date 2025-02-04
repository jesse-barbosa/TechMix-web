<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {

        // Fetch reviews with related users
        $reviews = Review::with('user')->get();


        // Pass the reviews to the view
        return view('avaliacoes', ['reviews' => $reviews]);
    }
}