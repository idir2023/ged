@extends('layouts.master')

@section('title', 'Ajouter un VIP')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Utilisateurs')
        @slot('title', 'Ajouter un VIP')
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
                    <h4 class="card-title">Créer un VIP</h4>

                    <form action="{{ route('manage_users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('manage_users.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
