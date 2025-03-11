@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container">
    <h3 class="text-center mt-4">E-Waste Puzzle Game - {{ ucfirst(request()->segment(3)) }} Level</h3>

    <h4 class="mt-4">Definitions:</h4>
    <div class="definitions">
        @foreach($words as $word => $definition)
            <div class="definition-item mb-3">
                <span class="definition-text">{{ $definition }}</span>
                <div class="dropzone" data-word="{{ $word }}"></div>
            </div>
        @endforeach
    </div>

    <h4 class="mt-4">Drag the Words:</h4>
    <div class="draggable-words">
        @foreach($shuffledWords as $shuffledWord)
            <div class="draggable-word" draggable="true" data-word="{{ $shuffledWord }}">{{ $shuffledWord }}</div>
        @endforeach
    </div>

    <button class="btn btn-success mt-3" id="checkAnswersButton">Check Answers</button>
</div>

<style>
    /* Improved styles for better appearance */
    .definition-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .definition-text {
        width: 60%;
        font-size: 1.1rem;
        font-weight: bold;
    }
    .dropzone {
        width: 35%;
        height: 40px; /* Reduced height */
        border: 2px dashed #28a745;
        background-color: #f2fef4;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    .draggable-word {
        display: inline-block;
        padding: 6px 12px; /* Reduced size */
        background-color: #d4edda;
        border: 2px solid #28a745;
        border-radius: 8px;
        margin: 5px;
        font-size: 0.9rem; /* Reduced font size */
        cursor: grab;
        transition: background-color 0.3s;
    }
    .draggable-word:hover {
        background-color: #c3e6cb;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Drag and drop logic
        let draggedWord = null;

        document.querySelectorAll('.draggable-word').forEach(word => {
            word.addEventListener('dragstart', function(event) {
                draggedWord = event.target;
                event.dataTransfer.setData("text/plain", event.target.dataset.word);
            });
        });

        document.querySelectorAll('.dropzone').forEach(zone => {
            zone.addEventListener('dragover', function(event) {
                event.preventDefault();
            });

            zone.addEventListener('drop', function(event) {
                event.preventDefault();
                if (!zone.hasChildNodes()) {
                    const word = draggedWord.cloneNode(true);
                    zone.appendChild(word);
                }
            });
        });

        // Check answers
        document.getElementById('checkAnswersButton').addEventListener('click', function() {
            let correctCount = 0;
            document.querySelectorAll('.dropzone').forEach(zone => {
                if (zone.hasChildNodes() && zone.firstChild.dataset.word === zone.dataset.word) {
                    correctCount++;
                }
            });

            if (correctCount === {{ count($words) }}) {
                Swal.fire({
                    title: 'You won!',
                    text: 'All words matched correctly!',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Next Level',
                    cancelButtonText: '🏠 Back to Dashboard'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "";
                    } else {
                        window.location.href = "{{ route('user.dashboard') }}";
                    }
                });
            } else {
                Swal.fire({
                    title: 'Try Again!',
                    text: 'Not all words are correct. Keep trying!',
                    icon: 'info'
                }).then(() => {
                    location.reload(); // Reload the page to reset the game
                });
            }
        });
    });
</script>
@endsection