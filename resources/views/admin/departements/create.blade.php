@extends('layouts.master')

@section('title')
    @lang('Créer un Département')
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
            @lang('Créer un Département')
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

                    <form action="{{ route('departements.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <label for="nom_dep" class="col-sm-3 col-form-label">@lang('Nom du Département')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nom_dep" name="nom_dep" value="{{ old('nom_dep') }}" required>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">@lang('Créer')</button>
                                <a href="{{ route('departements.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
