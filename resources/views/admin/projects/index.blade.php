@extends('layouts.master')

@section('title', 'Gestion des Projets')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1', 'Projets')
        @slot('title', 'Gestion des Projets')
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('projects.create') }}" class="btn btn-rounded btn-success">
                            <i class="bx bx-plus"></i> Ajouter un Projet
                        </a>
                    </div>

                    <table class="table table-bordered w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Zone</th>
                                <th>Chef de Projet</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->zone->nom }}</td>
                                    <td>{{ $project->chef->name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bx bx-edit"></i> <!-- Edit icon -->
                                        </a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bx bx-trash"></i> <!-- Delete icon -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
