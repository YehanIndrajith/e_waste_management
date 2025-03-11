@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="image_matching">
    <div class="container">
        <h2 class="text-center mt-2">Match the E-Waste Items to Their Categories</h2>
        <p class="text-center">Drag the images to the correct category.Ones you placed an image in a dropbox you won't be allowed to change it untill you finish the game.</p>

        <div class="text-center mt-3">
            <button id="checkAnswers" class="btn btn-success btn-lg">✔ Check Answers</button>
        </div>

        <div class="row mt-3 d-flex">
            <!-- Images & Dropzones -->
            <div class="col-md-4 d-flex flex-wrap align-items-center">
                <h4 class="text-center w-100 mb-3">🔄 Drag Items</h4>
                <div id="image-container" class="d-flex flex-wrap justify-content-center">
                    @foreach($images->take(6) as $image)
                        <div class="draggable-item">
                            <img src="{{ asset('images/ewaste/' . $image->image) }}" 
                                 alt="{{ $image->image }}" 
                                 class="draggable img-fluid img-border" 
                                 width="110" height="110"
                                 data-category="{{ $image->category }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-7">
                <!-- First Row of Dropzones -->
                <h5 class="mt-2 mb-2">1. Match the images of the e-waste items to their correct disposal categories:</h2>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h4 class="text-center">♻️ Recycle</h4>
                        <div class="dropzone" id="recycle1" data-category="Recycle"></div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">☠️ Hazardous</h4>
                        <div class="dropzone" id="hazardous1" data-category="Hazardous"></div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">🔄 Re-use</h4>
                        <div class="dropzone" id="reuse1" data-category="Re-use"></div>
                    </div>
                </div>
                <!-- Second Row of Dropzones -->
                <div class="row">
                    <h5 class="mt-2 mb-2">2. Match these household electronics to the correct e-waste bin: </h2>
                    <div class="col-md-4">
                        <h4 class="text-center">♻️ Recycle</h4>
                        <div class="dropzone" id="recycle2" data-category="Recycle"></div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">☠️ Hazardous</h4>
                        <div class="dropzone" id="hazardous2" data-category="Hazardous"></div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">🔄 Re-use</h4>
                        <div class="dropzone mb-4" id="reuse2" data-category="Re-use"></div>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-3">
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <a href="{{route('user.activities.beginner.puzzle')}}" class="btn btn-secondary">Next Activity</a>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
                </div>
            </div>
            
        </div>
        
    </div>
    
</section>

<style>
    .dropzone {
        min-height: 200px;
        border: 2px dashed #ccc;
        background-color: #f9f9f9;
        text-align: center;
        padding: 10px;
        margin-top: 10px;
        position: relative;
    }
    .draggable {
        cursor: grab;
    }
    .img-border {
        border: 3px solid #007bff;
        border-radius: 10px;
        padding: 5px;
        background-color: white;
        margin: 5px;
    }
    .draggable-item {
        margin: 5px;
        padding: 5px;
    }
    #checkAnswers {
        position: relative;
        top: -10px;
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 10px 20px;
    }
    #checkAnswers:hover {
        background-color: #218838;
    }
    #image-container {
        max-height: 450px; /* Adjust to fit within view */
        overflow-y: auto;  /* Enable scrolling for long lists */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let draggables = document.querySelectorAll(".draggable");
        let dropzones = document.querySelectorAll(".dropzone");

        draggables.forEach(img => {
            img.draggable = true;
            img.addEventListener("dragstart", dragStart);
        });

        dropzones.forEach(zone => {
            zone.addEventListener("dragover", dragOver);
            zone.addEventListener("drop", drop);
            zone.dataset.correctMatches = 0;
        });

        function dragStart(event) {
            event.dataTransfer.setData("image_id", event.target.src);
            event.dataTransfer.setData("category", event.target.getAttribute("data-category"));
        }

        function dragOver(event) {
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            let droppedImageSrc = event.dataTransfer.getData("image_id");
            let droppedCategory = event.dataTransfer.getData("category");

            let targetCategory = event.target.getAttribute("data-category");

            let imgElement = document.createElement("img");
            imgElement.src = droppedImageSrc;
            imgElement.classList.add("img-fluid", "mt-2", "img-border");
            imgElement.width = 80;

            event.target.appendChild(imgElement);

            if (targetCategory === droppedCategory) {
                event.target.dataset.correctMatches = parseInt(event.target.dataset.correctMatches) + 1;
            }
        }

        document.getElementById("checkAnswers").addEventListener("click", function () {
    let totalCorrectMatches = 0;
    dropzones.forEach(zone => {
        totalCorrectMatches += parseInt(zone.dataset.correctMatches);
    });

    if (totalCorrectMatches === 6) {
        Swal.fire({
            title: "You won!",
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Next activity",
            cancelButtonText: "🏠 Back to Dashboard",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the next activity
                window.location.href = ""; // Make sure this route exists
            } else {
                // Redirect to the dashboard
                window.location.href = "{{ route('user.dashboard') }}";
            }
        });
    } else {
        Swal.fire({
            title: "Try Again!",
            icon: "info",
            text: "Not all matches are correct. Please try again.",
            showCancelButton: true,
            confirmButtonText: "🔄 Try Again",
            cancelButtonText: "🏠 Back to Dashboard",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Reload the page to allow another attempt
                location.reload();
            } else {
                // Redirect to the dashboard
                window.location.href = "{{ route('user.dashboard') }}";
            }
        });
    }
});
    });
</script>

@endsection