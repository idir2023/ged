@extends('layouts.master')

@section('title')
    @lang('Modifier une Zone')
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
            @lang('Modifier une Zone')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('zones.update', $zone->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">@lang('Nom de la Zone')</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                                value="{{ $zone->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">@lang('Ville')</label>
                            <input type="text" name="city" id="city" class="form-control"
                                value="{{ $zone->city }}" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">@lang('Pays')</label>
                            <input type="text" name="country" id="country" class="form-control"
                                value="{{ $zone->country }}" readonly required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="id_chef_zone" class="form-label">@lang('Chef de Zone')</label>
                            <select name="id_chef_zone" id="id_chef_zone" class="form-select">
                                <option value="">@lang('Sélectionner un chef de zone')</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $zone->id_chef_zone == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="id_chef_zone" class="form-label">@lang('Chef de Zone')</label>
                            <select name="id_chef_zone" id="id_chef_zone" class="form-select">
                                <option value="">@lang('Sélectionner un chef de zone')</option>
                                @foreach ($chefs_zone as $chef)
                                    <option value="{{ $chef->id }}"
                                        {{ old('id_chef_zone', $zone->id_chef_zone) == $chef->id ? 'selected' : '' }}>
                                        {{ $chef->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="map" style="height: 400px;" class="mb-3"></div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">@lang('Latitude')</label>
                            <input type="text" name="latitude" id="latitude" class="form-control"
                                value="{{ $zone->latitude }}" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">@lang('Longitude')</label>
                            <input type="text" name="longitude" id="longitude" class="form-control"
                                value="{{ $zone->longitude }}" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="coordinates" class="form-label">@lang('Coordonnées')</label>
                            <input type="text" name="coordinates" id="coordinates" class="form-control"
                                value="{{ $zone->latitude }}, {{ $zone->longitude }}" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('Mettre à jour')</button>
                        <a href="{{ route('zones.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
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
        var map = L.map('map').setView([{{ $zone->latitude }}, {{ $zone->longitude }}],
        10); // Centrer la carte sur la zone existante

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([{{ $zone->latitude }}, {{ $zone->longitude }}]).addTo(map);

        // Fonction pour récupérer la ville et le pays depuis l'API Nominatim
        function getCityCountry(lat, lng) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.address) {
                        document.getElementById('city').value = data.address.city || data.address.town || data.address
                            .village || '';
                        document.getElementById('country').value = data.address.country || '';
                    } else {
                        document.getElementById('city').value = '';
                        document.getElementById('country').value = '';
                    }
                })
                .catch(error => console.error('Erreur lors de la récupération de la ville et du pays:', error));
        }

        // Gestion du clic sur la carte pour modifier la position
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('coordinates').value = lat + ', ' + lng;

            // Appel de la fonction pour récupérer la ville et le pays
            getCityCountry(lat, lng);
        });
    </script>
@endsection
