<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class DepartementController extends Controller
{
    /**
     * Affiche la liste des départements avec DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Departement::with('chefDepartement')->select(['id', 'nom_dep', 'id_chef_departement']);

            return DataTables::of($data)
                ->addColumn('chef', function ($row) {
                    return $row->chefDepartement ? $row->chefDepartement->name : 'Non assigné';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('departements.edit', $row->id);
                    $deleteUrl = route('departements.destroy', $row->id);
                    return '
                        <a href="' . $editUrl . '" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Confirmer la suppression ?\')">Supprimer</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.departements.index');
    }

    /**
     * Affiche le formulaire de création d'un département.
     */
  
    public function create()
    {
        // Fetch only users who have the role "chef_departement"
        $chefs_departement = User::role('chef_departement')->get(); 
    
        return view('admin.departements.create', compact('chefs_departement'));
    }
    

    /**
     * Enregistre un nouveau département.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_dep' => 'required|string|max:255|unique:departements,nom_dep',
            'id_chef_departement' => 'nullable|exists:users,id',
        ]);

        Departement::create($request->all());

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un département.
     */
     
    public function edit(Departement $departement)
    {
        // Fetch only users who have the role "chef_departement"
        $chefs_departement = User::role('chef_departement')->get(); 
    
        return view('admin.departements.edit', compact('departement', 'chefs_departement'));
    }
    
    /**
     * Met à jour un département existant.
     */
    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'nom_dep' => 'required|string|max:255|unique:departements,nom_dep,' . $departement->id,
            'id_chef_departement' => 'nullable|exists:users,id',
        ]);

        $departement->update($request->all());

        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    /**
     * Supprime un département.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
