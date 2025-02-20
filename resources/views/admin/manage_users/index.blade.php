@extends('layouts.master')

@section('title', 'Gestion des Utilisateurs')

@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Utilisateurs')
        @slot('title', 'Gestion des Utilisateurs')
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <!-- ✅ Boutons pour Ajouter des Utilisateurs (Selon les Rôles) -->
                    @can('manage users') 
                    <div class="d-flex justify-content-end mb-4 gap-2">
                        @hasanyrole('Super Admin|Chef de Département')
                        <a href="{{ route('manage_users.create') }}" class="btn btn-rounded btn-success btn-sm">
                            <i class="bx bx-plus"></i> Ajouter un VIP
                        </a>
                        @endhasanyrole

                        @role('Super Admin')
                        <a href="{{ route('AddChefDepartement') }}" class="btn btn-rounded btn-primary btn-sm">
                            <i class="bx bx-plus"></i> Ajouter Chef de Département
                        </a>
                        @endrole

                        @hasanyrole('Super Admin|Chef de Département')
                        <a href="{{ route('AddChefZone') }}" class="btn btn-rounded btn-info btn-sm">
                            <i class="bx bx-plus"></i> Ajouter Chef de Zone
                        </a>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Chef de Zone')
                        <a href="{{ route('AddChefProjet') }}" class="btn btn-rounded btn-warning btn-sm">
                            <i class="bx bx-plus"></i> Ajouter Chef de Projet
                        </a>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Chef de Projet')
                        <a href="{{ route('AddEmployeProjet') }}" class="btn btn-rounded btn-secondary btn-sm">
                            <i class="bx bx-plus"></i> Ajouter Employé de Projet
                        </a>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Chef de Département')
                        <a href="{{ route('AddEmployeDepartement') }}" class="btn btn-rounded btn-dark btn-sm">
                            <i class="bx bx-plus"></i> Ajouter Employé de Département
                        </a>
                        @endhasanyrole
                    </div>
                    @endcan

                    <!-- ✅ Tableau des Utilisateurs -->
                    <table class="table table-bordered w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'Non renseigné' }}</td>

                                    <!-- ✅ Affichage des Rôles avec Badges Colorés -->
                                    <td>
                                        @if ($user->roles->isNotEmpty())
                                            @foreach ($user->roles as $role)
                                                <span class="badge 
                                                    @switch($role->name)
                                                        @case('Super Admin') bg-danger @break
                                                        @case('Chef de Département') bg-primary @break
                                                        @case('Chef de Zone') bg-info @break
                                                        @case('Chef de Projet') bg-warning @break
                                                        @case('Employé') bg-secondary @break
                                                        @default bg-light
                                                    @endswitch">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-light text-dark">Aucun rôle</span>
                                        @endif
                                    </td>

                                    <!-- ✅ Actions (Seulement pour les Administrateurs) -->
                                    <td>
                                        <div class="d-flex gap-2">
                                            @can('manage users')
                                            <!-- Bouton Modifier -->
                                            <a href="{{ route('manage_users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bx bx-edit"></i>
                                            </a>

                                            <!-- Bouton Supprimer -->
                                            <form action="{{ route('manage_users.destroy', $user->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- ✅ Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
