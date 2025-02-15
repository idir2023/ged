@extends('layouts.master')

@section('title')
    @lang('Créer un Chef de Département')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Chefs de Département')
        @endslot
        @slot('li_2')
            {{ route('chefs.index') }}
        @endslot
        @slot('title')
            @lang('Créer un Chef de Département')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('chefs.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <label for="nom_chef" class="col-sm-3 col-form-label">@lang('Nom')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nom_chef" name="nom_chef" value="{{ old('nom_chef') }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="prenom_chef" class="col-sm-3 col-form-label">@lang('Prénom')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="prenom_chef" name="prenom_chef" value="{{ old('prenom_chef') }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email_chef" class="col-sm-3 col-form-label">@lang('Email')</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email_chef" name="email_chef" value="{{ old('email_chef') }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="telephone_chef" class="col-sm-3 col-form-label">@lang('Téléphone')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telephone_chef" name="telephone_chef" value="{{ old('telephone_chef') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="mot_de_passe_chef_projet" class="col-sm-3 col-form-label">@lang('Mot de Passe')</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="mot_de_passe_chef_projet" name="mot_de_passe_chef_projet" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="id_dep" class="col-sm-3 col-form-label">@lang('Département')</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="id_dep" name="id_dep">
                                    <option value="">@lang('Sélectionner un département')</option>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->id_dep }}">{{ $departement->nom_dep }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">@lang('Créer')</button>
                                <a href="{{ route('chefdep.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
