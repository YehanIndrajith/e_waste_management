@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container mb-4">
    <h2 class="text-center mt-4">{{ ucfirst($level) }} Level Quiz Results</h2>
    <div class="alert alert-success">
        You have scored {{ $score }} out of 10! 
    </div>
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Return to Dashboard</a>
</div>
@endsection