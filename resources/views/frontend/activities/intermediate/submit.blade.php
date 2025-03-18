@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5">
    <h2>Quiz Results - {{ ucfirst($level) }} Level</h2>
    <p>Your score: {{ $score }} out of 10</p>

    <button id="goToDashboard" class="btn btn-primary mt-3">Go to Dashboard</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Quiz Completed!',
            text: 'You scored {{ $score }} points.',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('user.dashboard') }}";
            }
        });

        document.getElementById('goToDashboard').addEventListener('click', function() {
            window.location.href = "{{ route('user.dashboard') }}";
        });
    });
</script>

@endsection