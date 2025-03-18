<!-- resources/views/frontend/home/sections/large-banner.blade.php -->

<div class="large-banner">
    <!-- E-Waste Detection Form -->
    <div class="container mt-5">
        <div style="background: linear-gradient(to bottom right, #ffffff, #f0f9f1);
                    border-radius: 20px;
                    padding: 30px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(81, 187, 106, 0.2);">
            
            <!-- Header Section -->
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #218838; font-size: 2.2rem; font-weight: 600; margin-bottom: 15px;">
                    E-Waste Detection Tool
                </h2>
                <p style="color: #666; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Upload an image of electronic waste for instant analysis and detection
                </p>
            </div>

            <!-- Upload Section -->
            <div style="text-align: center; margin: 30px 0;">
                <div style="background: rgba(81, 187, 106, 0.1);
                            border: 2px dashed rgba(81, 187, 106, 0.3);
                            border-radius: 15px;
                            padding: 30px;
                            max-width: 700px;
                            margin: 0 auto;">
                    <input type="file" 
                           id="imageUpload" 
                           class="form-control" 
                           accept="image/*"
                           style="display: none;">
                    <label for="imageUpload" 
                           style="cursor: pointer;
                                  padding: 15px 30px;
                                  background: #ffffff;
                                  border-radius: 10px;
                                  color: #218838;
                                  border: 1px solid rgba(81, 187, 106, 0.3);
                                  transition: all 0.3s ease;">
                        <i class="fas fa-cloud-upload-alt" style="margin-right: 10px; font-size: 1.2rem;"></i>
                        Choose an Image
                    </label>
                    <p id="fileName" style="margin-top: 10px; color: #666;"></p>
                    <button onclick="uploadImage()" 
                            style="background: #218838;
                                   color: white;
                                   border: none;
                                   padding: 12px 30px;
                                   border-radius: 25px;
                                   margin-top: 15px;
                                   transition: all 0.3s ease;
                                   box-shadow: 0 4px 15px rgba(33, 136, 56, 0.2);">
                        <i class="fas fa-search" style="margin-right: 8px;"></i>
                        Analyze Image
                    </button>
                </div>
            </div>

            <!-- Results Container -->
            <div id="resultContainer" style="display: none; margin-top: 30px;">
                <!-- Results will be populated here -->
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File input change handler
            const imageUpload = document.getElementById('imageUpload');
            const fileName = document.getElementById('fileName');
            
            if (imageUpload && fileName) {
                imageUpload.addEventListener('change', function(e) {
                    fileName.textContent = e.target.files[0] ? e.target.files[0].name : 'No file selected';
                });
            }
        });

        function uploadImage() {
            const input = document.getElementById("imageUpload");
            const resultContainer = document.getElementById("resultContainer");
            
            if (!input || !resultContainer) {
                console.error("Required elements not found");
                return;
            }

            const file = input.files[0];
            if (!file) {
                alert("Please select an image");
                return;
            }

            const formData = new FormData();
            formData.append("image", file);

            // Show loading indicator
            resultContainer.innerHTML = `
                <div style="text-align: center; padding: 20px;">
                    <div class="spinner-border" role="status" style="color: #218838;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p style="margin-top: 10px; color: #666;">Analyzing image...</p>
                </div>
            `;
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
                // Populate results with proper error handling
                resultContainer.innerHTML = `
                    <!-- E-waste Alert -->
                    <div style="background: #f8d7da;
                                color: #721c24;
                                padding: 15px 20px;
                                border-radius: 10px;
                                text-align: center;
                                margin-bottom: 20px;
                                font-weight: 500;">
                        <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i>
                        E-waste Detected
                    </div>

                    <!-- Detection Details -->
                    <div style="background: white;
                                border-radius: 15px;
                                padding: 25px;
                                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);">
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                            <!-- Left Column -->
                            <div>
                                <h3 style="color: #218838; font-size: 1.3rem; margin-bottom: 15px;">
                                    Detected Labels
                                </h3>
                                <ul style="list-style-type: none; padding: 0; color: #dc3545;">
                                    ${data.labels ? data.labels.map(label => `<li><strong>${label}</strong></li>`).join('') : 'No labels detected'}
                                </ul>

                                <h3 style="color: #218838; font-size: 1.3rem; margin: 20px 0 15px;">
                                    Components
                                </h3>
                                <p style="color: #444;">${data.components ? data.components.join(", ") : "N/A"}</p>

                                <h3 style="color: #218838; font-size: 1.3rem; margin: 20px 0 15px;">
                                    Hazardous Materials
                                </h3>
                                <p style="color: #444;">${data.Hazardous_Materials ? data.Hazardous_Materials.join(", ") : "N/A"}</p>
                            </div>

                            <!-- Right Column -->
                            <div>
                                <h3 style="color: #218838; font-size: 1.3rem; margin-bottom: 15px;">
                                    Health & Environmental Impact
                                </h3>
                                <p style="color: #444;">${data['Health & Environmental Impact'] ? data['Health & Environmental Impact'].join(", ") : "N/A"}</p>

                                <h3 style="color: #218838; font-size: 1.3rem; margin: 20px 0 15px;">
                                    Recyclability
                                </h3>
                                <p style="color: #444;">${data.Recyclability ? data.Recyclability.join(", ") : "N/A"}</p>
                            </div>
                        </div>

                        ${data.image_url ? `
                            <div style="margin-top: 30px; text-align: center;">
                                <h3 style="color: #218838; font-size: 1.3rem; margin-bottom: 15px;">
                                    Processed Image
                                </h3>
                                <img src="${data.image_url.replace(/\\/g, '/')}" 
                                     style="max-width: 100%;
                                            border-radius: 10px;
                                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                            </div>
                        ` : ''}
                    </div>
                `;
            })
            .catch(error => {
                console.error("Error:", error);
                resultContainer.innerHTML = `
                    <div style="background: #f8d7da;
                                color: #721c24;
                                padding: 15px 20px;
                                border-radius: 10px;
                                text-align: center;
                                margin-bottom: 20px;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                        ${error.message || 'An error occurred during processing'}
                    </div>
                `;
            });
        }
    </script>

    <style>
        button:hover {
            transform: translateY(-2px);
            background: #1a6e2e !important;
        }

        label[for="imageUpload"]:hover {
            background: rgba(81, 187, 106, 0.1) !important;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            [style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</div>