@extends('layouts.master')

@section('title')
    @lang('Modifier un Utilisateur')
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
            @lang('Modifier un Utilisateur')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('manage_users.update', $manage_user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('Nom')</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $manage_user->name) }}" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('Email')</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $manage_user->email) }}" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('Mot de passe')</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="text-muted">@lang('Laissez vide si vous ne souhaitez pas changer le mot de passe.')</small>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">@lang('Rôle')</label>
                            <select name="role" id="role" class="form-select" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $manage_user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">@lang('Photo de Profil')</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                            @if($manage_user->getFirstMediaUrl('avatars'))
                                <img src="{{ $manage_user->getFirstMediaUrl('avatars') }}" class="img-thumbnail mt-2" width="100">
                            @endif
                            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('Mettre à jour')</button>
                        <a href="{{ route('manage_users.index') }}" class="btn btn-secondary">@lang('Annuler')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
