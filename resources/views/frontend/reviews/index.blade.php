@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container">
    {{-- Logout Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-center">Reviews for {{ $collectionPoint->name }}</h3>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Logout</button>
        </form>
    </div>

    {{-- Logged-in User --}}
    <p><strong>Logged in as:</strong> {{ auth()->user()->name }}</p>

    {{-- Form to submit review --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('reviews.store', $collectionPoint->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rating">Rating (out of 5)</label>
                    <div class="star-rating">
                        <input type="hidden" name="rating" id="rating" required>
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review">Your Review</label>
                    <textarea name="review" id="review" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-2">Submit Review</button>
            </form>
        </div>
    </div>

    {{-- Display last 5 reviews --}}
    <h4>Recent Reviews</h4>
    @forelse ($reviews as $review)
        <div class="card mb-2">
            <div class="card-body">
                <strong>{{ $review->user->name }}</strong> - <span>{{ $review->rating }} ⭐</span>
                <p>{{ $review->review }}</p>
                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <p>No reviews yet. Be the first to review!</p>
    @endforelse
</div>

{{-- JavaScript for star rating --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function () {
                let ratingValue = this.getAttribute("data-value");
                ratingInput.value = ratingValue;

                // Reset all stars
                stars.forEach(s => s.classList.remove("selected"));

                // Highlight selected stars
                for (let i = 0; i < ratingValue; i++) {
                    stars[i].classList.add("selected");
                }
            });
        });
    });
</script>

{{-- CSS for styling stars --}}
<style>
    .star-rating {
        display: flex;
        font-size: 24px;
        cursor: pointer;
    }
    .star {
        color: gray;
        transition: color 0.2s;
    }
    .star:hover, .star.selected {
        color: gold;
    }
</style>

@endsection
