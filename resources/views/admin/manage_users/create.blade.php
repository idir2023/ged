@extends('layouts.master')

@section('title')
    @lang('Ajouter un Utilisateur')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Utilisateurs')
        @endslot
        @slot('li_2')
            {{ route('manage_users.index') }}
        @endslot
        @slot('title')
            @lang('Ajouter un Utilisateur')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('manage_users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('Nom')</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('Email')</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('Mot de passe')</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">@lang('Rôle')</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">@lang('Sélectionner un rôle')</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">@lang('Photo de Profil')</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('Enregistrer')</button>
                        <a href="{{ route('manage_users.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
