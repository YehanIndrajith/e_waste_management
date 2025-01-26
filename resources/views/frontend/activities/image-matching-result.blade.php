@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="image_matching_result">
    <div class="container text-center">
        <h3>Image Matching Results</h3>
        <p>You got <strong>{{ $correctAnswers }}</strong> out of <strong>{{ $totalQuestions }}</strong> correct!</p>
        <a href="{{ route('activities.image-matching') }}" class="btn btn-primary">Try Again</a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-success">Return to Dashboard</a>
    </div>
</section>
@endsection
