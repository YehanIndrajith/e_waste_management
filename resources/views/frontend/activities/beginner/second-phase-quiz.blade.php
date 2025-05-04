@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container mb-4">
    <h2 class="text-center mt-4">Second Phase Quiz - Level Wise</h2>

    {{-- Message at the top --}}
    <div class="alert alert-info mt-4 mb-4 text-center" style="font-size: 1.1rem;">
        <strong>You've completed the first step!</strong><br>
        Now, it's time to test your knowledge again.<br>
        This post-quiz helps you see how much you've learned about e-waste management.<br>
        <em>Let's see your progress and level up your awareness!</em>
    </div>

    <form action="{{ route('user.quiz.second-phase.submit') }}" method="POST">
        @csrf

        @foreach($questions as $index => $question)
            <div class="mb-4 quiz-question">
                <p><strong>{{ $index + 1 }}. {{ $question['question'] }}</strong></p>
                <div class="quiz-options">
                    @foreach($question['options'] as $option)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="answers[{{ $index }}]"
                                value="{{ $option }}"
                                id="question-{{ $index }}-option-{{ $loop->index }}"
                                style="width: 18px; height: 18px; border-radius: 50%; cursor: pointer;"
                            >
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
