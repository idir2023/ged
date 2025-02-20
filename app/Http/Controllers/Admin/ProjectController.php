<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 
 use App\Models\Project;
 use App\Models\Zone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Afficher la liste des projets.
     */
    
    public function index() {
        $user = auth()->user(); // Get the authenticated user
    
        if ($user->hasRole('Super Admin')) {
            // Super Admin sees all projects
            $projects = Project::with(['zone', 'chefProjet'])->paginate(10);
        } elseif ($user->hasRole('Chef de Zone')) {
            // Chef de Zone sees only projects in their assigned zone
            $projects = Project::with(['zone', 'chefProjet'])
                        ->where('zone_id', $user->zone_id)
                        ->paginate(10);
        } elseif ($user->hasRole('Chef de Projet')) {
            // Chef de Projet sees only the projects they manage
            $projects = Project::with(['zone', 'chefProjet'])
                        ->where('chef_projet_id', $user->id)
                        ->paginate(10);
        } else {
            // Other users have no access
            abort(403, 'Accès interdit.');
        }
    
        return view('admin.projects.index', compact('projects'));
    }
    

    /**
     * Afficher le formulaire de création d'un projet.
     */
    public function create()
    {
         $zones = Zone::all();
        $chefs = User::whereHas('roles', function ($query) {
            $query->where('name', 'chef_projet');
        })->get();

        return view('admin.projects.create', compact(  'zones', 'chefs'));
    }

    /**
     * Enregistrer un nouveau projet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name',
             'zone_id' => 'required|exists:zones,id',
            'chef_projet_id' => 'nullable|exists:users,id',
        
        ]);

        Project::create([
            'name' => $request->name,
             'zone_id' => $request->zone_id,
            'chef_projet_id' => $request->chef_projet_id,
          ]);

        return redirect()->route('projects.index')->with('success', 'Projet ajouté avec succès.');
    }

    /**
     * Modifier un projet.
     */
    public function edit(Project $project)
    {
         $zones = Zone::all();
        $chefs = User::whereHas('roles', function ($query) {
            $query->where('name', 'chef_projet');
        })->get();

        return view('admin.projects.edit', compact('project' , 'zones', 'chefs'));
    }
 
 
    /**
     * Mettre à jour un projet.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $project->id,
             'zone_id' => 'required|exists:zones,id',
            'chef_projet_id' => 'nullable|exists:users,id',
            
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
