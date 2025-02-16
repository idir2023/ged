@extends('layouts.master')

@section('title')
    @lang('Ajouter un Département')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Départements')
        @endslot
        @slot('li_2')
            {{ route('departements.index') }}
        @endslot
        @slot('title')
            @lang('Ajouter un Département')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('departements.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom_dep" class="form-label">@lang('Nom du Département')</label>
                            <input type="text" name="nom_dep" id="nom_dep" class="form-control" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="id_chef_departement" class="form-label">@lang('Chef de Département')</label>
                            <select name="id_chef_departement" id="id_chef_departement" class="form-select">
                                <option value="">@lang('Sélectionner un chef de département')</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
 
                        <div class="mb-3">
                            <label for="id_chef_departement" class="form-label">@lang('Chef de Département')</label>
                            <select name="id_chef_departement" id="id_chef_departement" class="form-select">
                                <option value="">@lang('Sélectionner un chef de département')</option>
                                @foreach($chefs_departement as $chef)
                                    <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">@lang('Enregistrer')</button>
                        <a href="{{ route('departements.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
