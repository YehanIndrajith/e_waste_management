@extends('frontend.dashboard.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content">
                    <div class="wsus__dashboard">
                        <section id="quiz_result">
                            <div class="container">
                                <h3 class="text-center">Quiz Results</h3>
                                <p>Your Score: {{ $correctAnswers }} / {{ $totalQuestions }}</p>
                                <p>Your Knowledge Level: {{ $level }} | Play the {{$level}} </p>
                                <p>Try the <span style="color: #007bff; font-weight: bold; text-decoration: underline;">{{ $level }}</span> Activities</p>
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
                                                <td>{{ $result['is_correct'] ? 'Correct' : 'Incorrect' }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="padding: 5px 0;">
                                                    <strong>Correct Answer: </strong>
                                                    <span class="{{ $result['is_correct'] ? 'text-success' : 'text-danger' }}">
                                                        @if($result['correct_answer'] == 'A')
                                                        {{ $result['option_a'] ?? 'N/A' }}
                                                       @elseif($result['correct_answer'] == 'B')
                                                        {{ $result['option_b'] ?? 'N/A' }}
                                                        @elseif($result['correct_answer'] == 'C')
                                                        {{ $result['option_c'] ?? 'N/A' }}
                                                        @elseif($result['correct_answer'] == 'D')
                                                        {{ $result['option_d'] ?? 'N/A' }}
                                                        @endif
                                                    
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Return to Dashboard and try {{$level}} Activites</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
