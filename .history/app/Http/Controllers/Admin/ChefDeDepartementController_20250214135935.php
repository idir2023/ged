<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChefDeDepartement;
use App\Models\Departement;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class ChefDeDepartementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ChefDeDepartement::with('departement')->select(['id_chef', 'nom_chef', 'prenom_chef', 'email_chef', 'telephone_chef', 'id_dep']);
            return DataTables::of($data)
                ->addColumn('departement', function ($row) {
                    return $row->departement ? $row->departement->nom_dep : 'Aucun';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('chefs.edit', $row->id_chef);
                    $deleteUrl = route('chefs.destroy', $row->id_chef);
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

        return view('admin.chefdep.index');
    }

    public function create()
    {
        $departements = Departement::all();
        return view('admin.chefdep.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_chef' => 'required|string|max:50',
            'prenom_chef' => 'required|string|max:50',
            'email_chef' => 'required|email|unique:chef_de_departements,email_chef',
            'telephone_chef' => 'nullable|string|max:15',
            'mot_de_passe_chef_projet' => 'required|string|min:6',
            'id_dep' => 'nullable|exists:departements,id_dep',
        ]);

        ChefDeDepartement::create([
            'nom_chef' => $request->nom_chef,
            'prenom_chef' => $request->prenom_chef,
            'email_chef' => $request->email_chef,
            'telephone_chef' => $request->telephone_chef,
            'mot_de_passe_chef_projet' => Hash::make($request->mot_de_passe_chef_projet),
            'id_dep' => $request->id_dep,
        ]);

        return redirect()->route('chefdep.index')->with('success', 'Chef de département ajouté avec succès.');
    }

    public function edit($id_chef)
    {
        $chef = ChefDeDepartement::findOrFail($id_chef);
        $departements = Departement::all();
        return view('admin.chefs.edit', compact('chef', 'departements'));
    }

    public function update(Request $request, $id_chef)
    {
        $chef = ChefDeDepartement::findOrFail($id_chef);

        $request->validate([
            'nom_chef' => 'required|string|max:50',
            'prenom_chef' => 'required|string|max:50',
            'email_chef' => 'required|email|unique:chef_de_departements,email_chef,' . $id_chef . ',id_chef',
            'telephone_chef' => 'nullable|string|max:15',
            'mot_de_passe_chef_projet' => 'nullable|string|min:6',
            'id_dep' => 'nullable|exists:departements,id_dep',
        ]);

        $chef->update([
            'nom_chef' => $request->nom_chef,
            'prenom_chef' => $request->prenom_chef,
            'email_chef' => $request->email_chef,
            'telephone_chef' => $request->telephone_chef,
            'mot_de_passe_chef_projet' => $request->mot_de_passe_chef_projet ? Hash::make($request->mot_de_passe_chef_projet) : $chef->mot_de_passe_chef_projet,
            'id_dep' => $request->id_dep,
        ]);

        return redirect()->route('chefs.index')->with('success', 'Chef de département mis à jour avec succès.');
    }

    public function destroy($id_chef)
    {
        $chef = ChefDeDepartement::findOrFail($id_chef);
        $chef->delete();

        return redirect()->route('chefs.index')->with('success', 'Chef de département supprimé avec succès.');
    }
}
