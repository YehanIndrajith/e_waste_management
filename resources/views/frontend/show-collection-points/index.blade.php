@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container">
    <h3 class="mt-3 mb-3 d-flex justify-content-center">Find Certified Collection Points</h3>
    <div id="map" style="height: 700px; width: 100%;"></div>
    
    <div class="text-center mt-4">
        <button id="findNearestButton" class="btn btn-primary">Find Nearest Collection Point</button>
        
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var map = L.map('map').setView([6.9271, 79.8612], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var routeLayer;
        var collectionPoints = @json($collectionPoints);

        if (Array.isArray(collectionPoints) && collectionPoints.length > 0) {
        collectionPoints.forEach(function (point) {
            // Ensure `average_rating` exists before using `.toFixed(1)`
            var averageRating = (point.average_rating !== undefined) ? point.average_rating.toFixed(1) + " ⭐" : "No ratings yet";

            L.marker([point.latitude, point.longitude]).addTo(map)
                .bindPopup(`
                    <strong>${point.name}</strong><br>
                    ${point.address}<br>
                    Contact: ${point.contact_info}<br>
                  
                    <a href="/reviews/${point.id}" class="btn btn-primary btn-sm mt-2" style="color: red;">Leave a Review</a>
                `);
        });
    } else {
            console.warn('No collection points available.');
        }

        document.getElementById('findNearestButton').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    L.marker([userLat, userLng]).addTo(map)
                        .bindPopup('You are here.')
                        .openPopup();

                    fetch("{{ route('frontend.show-collection-points.nearest') }}", {
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

                            L.marker([nearestPoint.latitude, nearestPoint.longitude]).addTo(map)
                                .bindPopup(`<strong>${nearestPoint.name}</strong><br>${nearestPoint.address}<br>Contact: ${nearestPoint.contact_info}`)
                                .openPopup();

                            if (routeLayer) {
                                map.removeLayer(routeLayer);
                            }

                            fetch(`https://router.project-osrm.org/route/v1/driving/${userLng},${userLat};${nearestPoint.longitude},${nearestPoint.latitude}?overview=full&geometries=geojson`)
                                .then(routeResponse => routeResponse.json())
                                .then(routeData => {
                                    if (routeData.routes.length > 0) {
                                        routeLayer = L.geoJSON(routeData.routes[0].geometry, {
                                            style: { color: 'blue', weight: 4 }
                                        }).addTo(map);
                                        map.fitBounds(routeLayer.getBounds());
                                    } else {
                                        alert('No route found.');
                                    }
                                })
                                .catch(error => console.error('Error fetching route:', error));
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error fetching nearest point:', error));
                }, error => {
                    alert("Geolocation Error: " + (error.message || "Unknown error."));
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
    });
</script>
@endsection
