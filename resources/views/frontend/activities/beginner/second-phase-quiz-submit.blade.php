@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container mb-4">
    <h2 class="text-center mt-4">Second Phase Quiz - Beginner Level</h2>
    <form action="{{}}" method="POST">
        @csrf
        @foreach($questions as $index => $question)
            <div class="mb-4 quiz-question">
                <p><strong>{{ $index + 1 }}. {{ $question['question'] }}</strong></p>
                <div class="quiz-options">
                    @foreach($question['options'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}]" value="{{ $option }}" id="question-{{ $index }}-option-{{ $loop->index }}">
                            <label class="form-check-label" for="question-{{ $index }}-option-{{ $loop->index }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit Quiz</button>
        </div>
    </form>
</div>
@endsection