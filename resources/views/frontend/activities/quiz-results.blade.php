@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5" style="background-color: #d4edda; border-radius: 10px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="color: #155724; font-weight: bold;">Quiz Result</h2>

    @if(session('score') !== null && session('total') !== null)
        <p style="font-size: 18px; color: #155724; font-weight: bold;">
            <strong>Your Score:</strong> {{ session('score') }} / {{ session('total') }}
        </p>

        {{-- Buttons --}}
        <div style="margin-top: 20px;">
            <a href="{{ route('user.dashboard') }}" 
               class="btn" 
               style="background-color: #155724; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Back to Dashboard
            </a>
        </div>
    @else
        <p style="font-size: 18px; color: #721c24; font-weight: bold;">No quiz results found. Please take the quiz first.</p>
        
        <div style="margin-top: 20px;">
            <a href="{{ route('user.dashboard') }}" 
               class="btn" 
               style="background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Go to Dashboard
            </a>
        </div>
    @endif
</div>
@endsection
