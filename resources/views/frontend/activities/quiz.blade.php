{{-- @extends('frontend.dashboard.layouts.master') --}}

@section('content1')
<div class="container">
    <h2>Quiz</h2>
    <form action="{{ route('user.quiz.second-phase.submit') }}" method="POST">

        @csrf
        <input type="hidden" name="level" value="{{ request()->segment(3) }}">
        
        @foreach($questions as $index => $question)
            <div class="mb-4">
                <p><strong>{{ $index + 1 }}. {{ $question['question'] }}</strong></p>
                @foreach($question['options'] as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_{{ $index }}" value="{{ $option }}" required>
                        <label class="form-check-label">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
