<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Departement;
use Yajra\DataTables\Facades\DataTables;

 
class DepartementController extends Controller
{
     
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Departement::select(['id_dep', 'nom_dep']);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('departements.edit', $row->id_dep);
                    $deleteUrl = route('departements.destroy', $row->id_dep);
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
    

    public function create()
    {
        return view('admin.departements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_dep' => 'required|string|max:255|unique:departements'
        ]);

        Departement::create($request->all());

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    public function edit($id_dep)
    {
        $departement = Departement::findOrFail($id_dep);
        return view('admin.departements.edit', compact('departement'));
    }

    public function update(Request $request, $id_dep)
    {
        $request->validate([
            'nom_dep' => 'required|string|max:255|unique:departements,nom_dep,' . $id_dep . ',id_dep'
        ]);

        $departement = Departement::findOrFail($id_dep);
        $departement->update($request->all());

        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy($id_dep)
    {
        $departement = Departement::findOrFail($id_dep);
        $departement->delete();

        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
