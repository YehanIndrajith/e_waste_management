<!-- intermedaite post quiz result blade -->
 
@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5" style="background-color: #d4edda; border-radius: 10px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="color: #155724; font-weight: bold;">Quiz Result</h2>

    @if(session('score') !== null && session('total') !== null)
        <p style="font-size: 18px; color: #155724; font-weight: bold;">
            <strong>Your Score:</strong> {{ session('score') }} / {{ session('total') }}
        </p>

        <div class="mt-4" style="text-align: left;">
            <h4 style="color: #155724; font-weight: bold;">Questions and Answers:</h4>

            @php
                $questionResults = session('questionResults', []);
            @endphp

            @foreach ($questionResults as $result)
                <div style="margin-bottom: 15px;">
                    <strong>Q: {{ $result['question'] }}</strong>
                    <p>Your Answer: 
                        <span style="color: {{ $result['is_correct'] ? '#155724' : '#d9534f' }};">
                            {{ $result['user_answer'] }}
                        </span>
                    </p>
                    <p>Correct Answer: 
                        <span style="color: #155724;">
                            {{ $result['correct_answer'] }}
                        </span>
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Buttons --}}
        <div style="margin-top: 20px;">
            <a href="{{ route('user.dashboard') }}" 
               class="btn" 
               style="background-color: #155724; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Return to Dashboard 
            </a>
        </div>
    @else
        <p style="font-size: 18px; color: #721c24; font-weight: bold;">No quiz results found. Please take the quiz first.</p>
        
        <div style="margin-top: 20px;">
            <a href="{{ route('user.dashboard') }}" 
               class="btn" 
               style="background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Return to Dashboard
            </a>
        </div>
    @endif
</div>
@endsection