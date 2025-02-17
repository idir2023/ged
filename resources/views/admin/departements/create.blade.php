@extends('layouts.master')

@section('title', 'Ajouter un Département')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Départements')
        @slot('li_2', route('departements.index'))
        @slot('title', 'Ajouter un Département')
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('departements.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du Département</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
