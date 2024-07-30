<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;


class ReviewController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store', 'update', 'destroy']),
            new Middleware('verified', only: ['store']), // Only users with verified email can create a review
        ];
    }

    public function index(): AnonymousResourceCollection
    {
        $reviews = Review::all();
        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request): ReviewResource
    {
        $user = auth()->user();
        $data = $request->validated();
        $review = $user->reviews()->create($data);
        return new ReviewResource($review);
    }

    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review);
    }

    public function update(UpdateReviewRequest $request, Review $review): ReviewResource
    {
        Gate::authorize('update', $review);  // only the owner or admin can update the review
        $data = $request->validated();
        $review->update($data);
        return new ReviewResource($review);
    }

    public function destroy(Review $review): Response
    {
        Gate::authorize('delete', $review);  // only the owner or admin can delete the review
        $review->delete();  // Soft delete the review
        return response()->noContent();
    }
}
