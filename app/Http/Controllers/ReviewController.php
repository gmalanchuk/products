<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReviewController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store', 'update', 'destroy']),
            new Middleware('verified', only: ['store']), // Only users with verified email can create a review
        ];
    }

    public function index()
    {
        $reviews = Review::all();
        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request)
    {
        $user = auth()->user();
        $review = $user->reviews()->create($request->validated());
        return new ReviewResource($review);
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function update(Request $request, string $id)
    {
        // todo only owner or admin
    }

    public function destroy(string $id)
    {
        // todo only owner or admin
    }
}
