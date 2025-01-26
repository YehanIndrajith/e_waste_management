@extends('frontend.dashboard.layouts.master')

@section('content')

<div class="container">
    <h3>Quiz Results</h3>
    <p>Your Score: {{ $correctAnswers }} / {{ $totalQuestions }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result['question'] }}</td>
                    <td>{{ $result['user_answer'] }}</td>
                    <td>{{ $result['correct_answer'] }}</td>
                    <td>{{ $result['is_correct'] ? '✔️' : '❌' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('user.activities.intermediate.quiz') }}" class="btn btn-primary">Try Again</a>
</div>

@endsection
