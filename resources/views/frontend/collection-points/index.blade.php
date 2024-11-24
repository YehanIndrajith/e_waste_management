@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container">
    {{-- Optional sidebar, uncomment if needed --}}
    @include('frontend.dashboard.layouts.sidebar')

    <h3>Find Certified Collection Points</h3>
    <div id="map" style="float: right; height: 700px; width: 95%;">
    </div>
    
 {{-- Button to find the nearest collection point --}}
 <div class="mt-12 text-center" style="margin-top: 40px;">
    <button id="findNearestButton" class="btn btn-primary mt-3">Find Nearest Collection Point</button>
   </div>

</div>

  

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize the map
        var map = L.map('map').setView([6.9271, 79.8612], 12); // Default view (Colombo)

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Layer for route display
        var routeLayer;

        // Display all certified collection points
        var collectionPoints = @json($collectionPoints);

        if (Array.isArray(collectionPoints) && collectionPoints.length > 0) {
            collectionPoints.forEach(function (point) {
                L.marker([point.latitude, point.longitude]).addTo(map)
                    .bindPopup(`<strong>${point.name}</strong><br>${point.address}<br>Contact: ${point.contact_info}`);
            });
        } else {
            console.warn('No collection points available to display.');
        }

        // Button to find the nearest collection point
        document.getElementById('findNearestButton').addEventListener('click', function() {
            // Check if geolocation is supported
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;

                        // Add marker for user's location
                        L.marker([userLat, userLng]).addTo(map)
                            .bindPopup('You are here.')
                            .openPopup();

                        // Fetch the nearest collection point
                        fetch("{{ route('user.collectionPoints.nearest') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ latitude: userLat, longitude: userLng })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                var nearestPoint = data.data;

                                // Add marker for the nearest collection point
                                L.marker([nearestPoint.latitude, nearestPoint.longitude]).addTo(map)
                                    .bindPopup(`<strong>${nearestPoint.name}</strong><br>${nearestPoint.address}<br>Contact: ${nearestPoint.contact_info}`)
                                    .openPopup();

                                // Fetch and display the route
                                if (routeLayer) {
                                    map.removeLayer(routeLayer);
                                }

                                fetch(`https://router.project-osrm.org/route/v1/driving/${userLng},${userLat};${nearestPoint.longitude},${nearestPoint.latitude}?overview=full&geometries=geojson`)
                                    .then(routeResponse => routeResponse.json())
                                    .then(routeData => {
                                        if (routeData.routes && routeData.routes.length > 0) {
                                            var route = L.geoJSON(routeData.routes[0].geometry, {
                                                style: { color: 'blue', weight: 4 }
                                            }).addTo(map);

                                            routeLayer = route;

                                            // Fit map to route bounds
                                            map.fitBounds(route.getBounds());
                                        } else {
                                            console.error('No route found.');
                                        }
                                    })
                                    .catch(error => console.error('Error fetching route:', error));
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error fetching nearest point:', error));
                    },
                    function (error) {
                        // Handle geolocation errors
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert("Geolocation access denied by user.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("Geolocation position unavailable.");
                                break;
                            case error.TIMEOUT:
                                alert("Geolocation request timed out.");
                                break;
                            default:
                                alert("An unknown error occurred.");
                                break;
                        }
                    }
                );
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
    });
</script>
@endsection
