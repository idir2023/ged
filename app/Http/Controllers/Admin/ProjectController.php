<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 
 use App\Models\Project;
use App\Models\Departement;
use App\Models\Zone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Afficher la liste des projets.
     */
    public function index()
    {
        $projects = Project::with(['departement', 'zone', 'chef'])->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Afficher le formulaire de création d'un projet.
     */
    public function create()
    {
        $departements = Departement::all();
        $zones = Zone::all();
        $chefs = User::whereHas('roles', function ($query) {
            $query->where('name', 'chef_projet');
        })->get();

        return view('admin.projects.create', compact('departements', 'zones', 'chefs'));
    }

    /**
     * Enregistrer un nouveau projet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name',
            'departement_id' => 'nullable|exists:departements,id',
            'zone_id' => 'required|exists:zones,id',
            'chef_id' => 'nullable|exists:users,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Project::create([
            'name' => $request->name,
            'departement_id' => $request->departement_id,
            'zone_id' => $request->zone_id,
            'chef_id' => $request->chef_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
         ]);

        return redirect()->route('projects.index')->with('success', 'Projet ajouté avec succès.');
    }

    /**
     * Modifier un projet.
     */
    public function edit(Project $project)
    {
        $departements = Departement::all();
        $zones = Zone::all();
        $chefs = User::whereHas('roles', function ($query) {
            $query->where('name', 'chef_projet');
        })->get();

        return view('admin.projects.edit', compact('project', 'departements', 'zones', 'chefs'));
    }

    /**
     * Mettre à jour un projet.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $project->id,
            'departement_id' => 'nullable|exists:departements,id',
            'zone_id' => 'required|exists:zones,id',
            'chef_id' => 'nullable|exists:users,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Supprimer un projet.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}
