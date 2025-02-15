@extends('layouts.master')

@section('title')
    @lang('Ajouter une Zone')
@endsection

@section('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Zones')
        @endslot
        @slot('li_2')
            {{ route('zones.index') }}
        @endslot
        @slot('title')
            @lang('Ajouter une Zone')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('zones.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">@lang('Nom de la Zone')</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>

                        <div id="map" style="height: 400px;"></div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">@lang('Latitude')</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">@lang('Longitude')</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('Enregistrer')</button>
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
        var map = L.map('map').setView([33.5731, -7.5898], 6); // Maroc par défaut

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
@endsection
