{{-- @extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container text-center mt-5">
    <h2>Quiz Results - {{ ucfirst($level) }} Level</h2>
    <p>Your score: {{ $score }} out of 10</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Quiz Completed!',
            html: `You scored <strong>{{ $score }}</strong> points out of 10.`,
            icon: 'success',
            confirmButtonText: 'Go to Dashboard',
            willClose: () => {
                window.location.href = "{{ route('user.dashboard') }}";
            }
        });
    });
</script>
@endsection --}}