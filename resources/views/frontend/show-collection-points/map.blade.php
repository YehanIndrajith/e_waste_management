@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="container">
    <h3>Find Certified Collection Points</h3>
    <div id="map" style="height: 500px;"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize the map
        var map = L.map('map').setView([40.712776, -74.005974], 12); // Default coordinates

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Get User Location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;

                // Center map to user's location
                map.setView([userLat, userLng], 12);

                // Add marker for user's location
                L.marker([userLat, userLng]).addTo(map)
                    .bindPopup('You are here.')
                    .openPopup();
            });
        }

        // Certified Collection Points (replace with dynamic data from backend)
        var collectionPoints = @json($collectionPoints);

        collectionPoints.forEach(function(point) {
            L.marker([point.latitude, point.longitude]).addTo(map)
                .bindPopup(`<strong>${point.name}</strong><br>${point.address}<br>Contact: ${point.contact_info}`);
        });
    });
</script>
@endsection
