<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement; // Vérifie que c'est bien le modèle correct
use Yajra\DataTables\Facades\DataTables;

class DepartementController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $departments = Departement::select('departements.*'); // Vérifie le bon modèle et nom de table

            return DataTables::of($departments)
                ->addColumn('action', function ($department) {
                    return '
                        <a href="'.route('departements.edit', $department->id).'" class="btn btn-sm btn-primary">Éditer</a>
                        <form action="'.route('departements.destroy', $department->id).'" method="POST" class="d-inline">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Supprimer ce département ?\')">Supprimer</button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.departements.index');
    }

    public function create() {
        return view('admin.departements.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:departements,name', // Vérifie la table correcte
        ]);

        Departement::create([
            'name' => $request->name,
        ]);

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    public function edit(Departement $departement) {
        return view('admin.departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement) {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255|unique:departements,name,'.$departement->id,
        ]);
    
        // Mise à jour du département
        $departement->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }
    

    public function destroy(Departement $department) {
        $department->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
