@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container mb-3">
    <h2 class="text-center mt-4">Pro Level Trivia Quiz</h2>
    <form action="{{ route('user.activities.pro.trivia.submit') }}" method="POST">
        @csrf
        @foreach($questions as $question)
            <div class="mb-4">
                <p><strong>{{ $loop->iteration }}. {{ $question->question }}</strong></p>
                @foreach(['a', 'b', 'c', 'd'] as $option)
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question['option_'.$option] }}">
                        {{ $question['option_'.$option] }}
                    </label><br>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Submit Answers</button>
        <a href="{{ route('user.activities.pro.image-matching') }}" class="btn btn-secondary">Next Activity</a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
    </form>
</div>
@endsection
