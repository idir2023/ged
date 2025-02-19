@extends('layouts.master')

@section('title', 'Ajouter une Zone')

@section('css')
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
        @slot('title', 'Ajouter une Zone')
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('zones.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la Zone</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sélectionner l'emplacement</label>
                            <div id="map"></div>
                        </div>

                        <input type="hidden" id="latitude" name="latitude" required>
                        <input type="hidden" id="longitude" name="longitude" required>
                        <input type="hidden" id="coordinates" name="coordinates">
                        <input type="hidden" id="city" name="city">
                        <input type="hidden" id="country" name="country">

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var map = L.map('map').setView([33.5731, -7.5898], 6);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([33.5731, -7.5898], { draggable: true }).addTo(map);

            function updateLatLng(lat, lng) {
                $('#latitude').val(lat.toFixed(6));
                $('#longitude').val(lng.toFixed(6));
                $('#coordinates').val(lat.toFixed(6) + ', ' + lng.toFixed(6));
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

                $.getJSON(url, function (data) {
                    if (data.address) {
                        let city = data.address.city || data.address.town || data.address.village || '';
                        let country = data.address.country || '';
                        let zone = data.address.state || data.address.county || '';

                        $('#city').val(city);
                        $('#country').val(country);

                        // Populate zone dropdown
                        if (zone) {
                            $('#zone').html(`<option value="${zone}" selected>${zone}</option>`);
                        }
                    }
                }).fail(function () {
                    console.error('Error fetching location details.');
                });
            }
        });
    </script>
@endsection
