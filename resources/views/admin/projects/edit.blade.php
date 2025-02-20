@extends('layouts.master')

@section('title', 'Modifier un Projet')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Projets')
        @slot('title', 'Modifier un Projet')
    @endcomponent

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <h4 class="card-title">Modifier le Projet</h4>

                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du Projet</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $project->name) }}" required>
                        </div>

                         <div class="mb-3">
                            <label for="zone_id" class="form-label">Zone</label>
                            <select class="form-control" id="zone_id" name="zone_id" required>
                                <option value="">Sélectionner une zone</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}"
                                        {{ $project->zone_id == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
