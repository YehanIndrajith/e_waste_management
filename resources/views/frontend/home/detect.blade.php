@extends('frontend.home.layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Upload an Image for E-Waste Detection</h2>

        <div class="text-center">
            <input type="file" id="imageUpload" class="form-control mt-3" accept="image/*">
            <button class="btn btn-primary mt-3" onclick="uploadImage()">Upload</button>
        </div>

        <!-- Add this div with id="resultContainer" -->
        <div id="resultContainer" style="display: none;">
            <h3 class="mt-4">Detected Labels:</h3>
            <ul id="labelsList"></ul>

            <h3 class="mt-4">Processed Image:</h3>
            <img id="resultImage" style="max-width: 500px;" class="img-fluid mt-3">
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
       function uploadImage() {
            const input = document.getElementById("imageUpload");
            const file = input.files[0];
            
            if (!file) {
                alert("Please select an image");
                return;
            }

            const formData = new FormData();
            formData.append("image", file);

            // Show loading indicator
            const resultContainer = document.getElementById("resultContainer");
            resultContainer.innerHTML = '<div class="text-center mt-4"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            resultContainer.style.display = "block";

            fetch("{{ route('detect.image') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.details || 'Upload failed');
                    });
                }
                return response.json();
            })
            .then(data => {
                // Reset container content
                resultContainer.innerHTML = `
                    <h3 class="mt-4">Detected Labels:</h3>
                    <ul id="labelsList"></ul>
                    <h3 class="mt-4">Processed Image:</h3>
                    <img id="resultImage" style="max-width: 500px;" class="img-fluid mt-3">
                `;

                const labelsList = document.getElementById("labelsList");
                const resultImage = document.getElementById("resultImage");

                // Handle labels
                if (data.labels && data.labels.length > 0) {
                    labelsList.innerHTML = data.labels.map(label => `
                        <li class="mb-2">
                            <strong>${label}</strong>
                            ${data.components ? `<br>Components: ${data.components}` : ''}
                            ${data.Hazardous_Materials ? `<br>Hazardous Materials: ${data.Hazardous_Materials}` : ''}
                            ${data['Health & Environmental Impact'] ? `<br>Impact: ${data['Health & Environmental Impact']}` : ''}
                            ${data.Recyclability ? `<br>Recyclability: ${data.Recyclability}` : ''}
                        </li>
                    `).join("");
                } else {
                    labelsList.innerHTML = "<li>No labels detected</li>";
                }
                
                // Handle image
                if (data.image_url) {
                    resultImage.src = data.image_url;
                    resultImage.style.display = "block";
                } else {
                    resultImage.style.display = "none";
                }
            })
            .catch(error => {
                console.error("Detailed Error:", error);
                resultContainer.innerHTML = `
                    <div class="alert alert-danger mt-4">
                        An error occurred: ${error.message}
                    </div>
                `;
            });
        }
    </script>
@endsection