@extends('frontend.home.layouts.master')

@section('content')
<div class="container collection-points-section">
    <div class="text-center mb-5">
        <h3 class="section-title" style="
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            font-weight: 800;
            display: inline-block;
            position: relative;
            padding-bottom: 10px;
        ">
            Find Certified Collection Points
            <span style="
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(to right, #2ecc71, #27ae60);
            "></span>
        </h3>
        <p class="text-muted mt-3">Discover eco-friendly collection points near you</p>
    </div>

    <div id="map" style="
        height: 500px; 
        width: 100%; 
        border-radius: 15px; 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border: 3px solid #2ecc71;
    "></div>
    
    <div class="text-center mt-4">
        <button id="findNearestButton" class="btn btn-green" style="
            background: linear-gradient(to right, #2ecc71, #27ae60);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(46,204,113,0.3);
        ">
            <i class="fas fa-map-marker-alt me-2"></i>
            Find Nearest Collection Point
        </button>
    </div>
</div>

<style>
    .collection-points-section {
        background-color: #f4f9f4;
        padding: 50px 0;
        border-radius: 20px;
    }

    .btn-green:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(46,204,113,0.4);
        background: linear-gradient(to right, #27ae60, #2ecc71);
    }

    @media (max-width: 768px) {
        #map {
            height: 800px;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>

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
