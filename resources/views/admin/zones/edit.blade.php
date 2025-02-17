@extends('layouts.master')

@section('title', 'Modifier une Zone')

@section('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Zones')
        @slot('li_2', route('zones.index'))
        @slot('title', 'Modifier la Zone')
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('zones.update', $zone->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la Zone</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $zone->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sélectionner l'emplacement</label>
                            <div id="map"></div>
                        </div>

                        <input type="hidden" id="latitude" name="latitude" value="{{ $zone->latitude }}" required>
                        <input type="hidden" id="longitude" name="longitude" value="{{ $zone->longitude }}" required>
                        <input type="hidden" id="coordinates" name="coordinates" value="{{ $zone->coordinates }}">
                        <input type="hidden" id="city" name="city" value="{{ $zone->city }}">
                        <input type="hidden" id="country" name="country" value="{{ $zone->country }}">

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var initialLat = {{ $zone->latitude }};
            var initialLng = {{ $zone->longitude }};
            var map = L.map('map').setView([initialLat, initialLng], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

            function updateLatLng(lat, lng) {
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                document.getElementById('coordinates').value = lat.toFixed(6) + ', ' + lng.toFixed(6);
                fetchLocationDetails(lat, lng);
            }

            marker.on('dragend', function (e) {
                var latLng = marker.getLatLng();
                updateLatLng(latLng.lat, latLng.lng);
            });

            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updateLatLng(e.latlng.lat, e.latlng.lng);
            });

            function fetchLocationDetails(lat, lng) {
                var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=10&addressdetails=1`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.address) {
                            let city = data.address.city || data.address.town || data.address.village || '';
                            let country = data.address.country || '';

                            document.getElementById('city').value = city;
                            document.getElementById('country').value = country;
                        }
                    })
                    .catch(error => console.error('Erreur lors de la récupération des données:', error));
            }
        });
    </script>
@endsection
