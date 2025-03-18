@extends('frontend.dashboard.layouts.master')

@section('content')


<div class="container mb-3">
    <h3 class="mt-3">Beginner Level Quiz</h3>
    <form action="{{ route('user.activities.beginner.quiz.checkAnswers') }}" method="POST">
        @csrf
        @foreach($quizzes as $quiz)
            <div class="quiz-question mb-4">
                <p><strong>{{ $quiz->question }}</strong></p>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="A"> {{ $quiz->option_a }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="B"> {{ $quiz->option_b }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="C"> {{ $quiz->option_c }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="D"> {{ $quiz->option_d }}</label>
            </div>
        @endforeach

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('user.activities.beginner.image-matching') }}" class="btn btn-secondary">Next Activity</a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
        </div>
    </form>
</div>

@endsection
