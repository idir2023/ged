<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Zone;
use App\Models\User;
use Spatie\Permission\Models\Role;


class ZoneController extends Controller
{
    /**
     * Affiche la liste des zones avec DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $zones = Zone::with('chefZone')->select(['id', 'nom', 'latitude', 'longitude', 'city', 'country', 'id_chef_zone']);

            return DataTables::of($zones)
                ->addColumn('chef_zone', function ($zone) {
                    return $zone->chefZone ? $zone->chefZone->name : 'Non assigné';
                })
                ->addColumn('action', function ($zone) {
                    return '
                        <a href="' . route('zones.edit', $zone->id) . '" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i>
                        </a>
                        <form action="' . route('zones.destroy', $zone->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Confirmer la suppression ?\')">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.zones.index');
    }

    /**
     * Affiche le formulaire de création d'une nouvelle zone.
     */
       
    public function create()
    {
        // Fetch only users who have the "chef_zone" role
        $chefs_zone = User::role('chef_zone')->get(); 
    
        return view('admin.zones.create', compact('chefs_zone'));
    }
    

 

    /**
     * Enregistre une nouvelle zone dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'id_chef_zone' => 'nullable|exists:users,id', // Vérifie si l'utilisateur existe
            'coordinates' => 'nullable|string',
        ]);

        Zone::create($request->all());

        return redirect()->route('zones.index')->with('success', 'Zone ajoutée avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'une zone.
     */
 
    
public function edit(Zone $zone)
{
    // Get only users who have the role "chef_zone"
    $chefs_zone = User::role('chef_zone')->get(); 

    return view('admin.zones.edit', compact('zone', 'chefs_zone'));
}


    /**
     * Met à jour une zone existante.
     */
    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'id_chef_zone' => 'nullable|exists:users,id',
            'coordinates' => 'nullable|string',
        ]);

        $zone->update($request->all());

        return redirect()->route('zones.index')->with('success', 'Zone mise à jour avec succès');
    }

    /**
     * Supprime une zone.
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone supprimée avec succès');
    }
}
