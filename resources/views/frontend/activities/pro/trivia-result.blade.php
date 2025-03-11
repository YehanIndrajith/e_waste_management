@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5">
    <h2>Your Score: {{ $score }} / {{ $totalQuestions }}</h2>
    @if($score == $totalQuestions)
        <p>🎉 Congratulations! You got all answers correct!</p>
    @elseif($score >= $totalQuestions / 2)
        <p>👍 Good job! Keep learning about e-waste!</p>
    @else
        <p>❌ Try again! Learn more about e-waste disposal.</p>
    @endif
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">🏠 Back to Dashboard</a>
</div>
@endsection
