<?php

namespace App\Http\Controllers;

use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreReviewRatingRequest;
use App\Http\Requests\UpdateReviewRatingRequest;

class ReviewRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReviewRating::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'rating' => 'required|max:5',
            'review' => 'required'
        ]);

        $reviewRating = $request->user()->reviewRating()->create($fields);

        return ['reviewRating' => $reviewRating, 'user' => $reviewRating->user];
    }

    /**
     * Display the specified resource.
     */
    public function show(ReviewRating $reviewRating)
    {
        return ['review_rating' => $reviewRating, 'user' => $reviewRating->user];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewRating $reviewRating)
    {
        Gate::authorize('modify', $reviewRating);

        $fields = $request->validate([
            'rating' => 'required|max:5',
            'review' => 'required'
        ]);

        $reviewRating->update($fields);

        return ['review_rating' => $reviewRating, 'user' => $reviewRating->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewRating $reviewRating)
    {
        Gate::authorize('modify', $reviewRating);

        $reviewRating->delete();

        return ['message' => 'The post was deleted'];
    }
}
