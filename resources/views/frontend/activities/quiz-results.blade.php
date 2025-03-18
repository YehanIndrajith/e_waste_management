@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5">
    <h2>Quiz Result</h2>

    @if(session('score') !== null && session('total') !== null)
        <p><strong>Your Score:</strong> {{ session('score') }} / {{ session('total') }}</p>

        {{-- Try Again and Back to Dashboard Buttons --}}
        
        <a href="{{route('user.dashboard')}}" class="btn btn-secondary">Back to Dashboard</a>
    @else
        <p class="text-danger">No quiz results found. Please take the quiz first.</p>
        <a href="{{route('user.dashboard')}}" class="btn btn-primary">Go to  Dashboard</a>
    @endif
</div>
@endsection
