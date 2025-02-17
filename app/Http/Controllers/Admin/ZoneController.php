<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Zone;
use App\Models\User;
use Spatie\Permission\Models\Role;

 
class ZoneController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $zones = Zone::with('chef')->select('zones.*');

            return DataTables::of($zones)
                ->addColumn('chef_zone', function ($zone) {
                    return $zone->chef ? $zone->chef->name : '-';
                })
                ->addColumn('action', function ($zone) {
                    return '
                        <a href="'.route('zones.edit', $zone->id).'" class="btn btn-sm btn-primary">Éditer</a>
                        <form action="'.route('zones.destroy', $zone->id).'" method="POST" class="d-inline">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Supprimer cette zone ?\')">Supprimer</button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.zones.index');
    }

    public function create() {
        $chefs = User::role('Chef de Zone')->get();
        return view('admin.zones.create', compact('chefs'));
    }

     
    public function store(Request $request) {
            // Validation des données
            $request->validate([
                'nom' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'coordinates' => 'required|string',
                'city' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
            ]);
    
            // Création de la Zone
            Zone::create([
                'nom' => $request->nom,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'coordinates' => $request->coordinates,
                'city' => $request->city,
                'country' => $request->country,
            ]);
    
            return redirect()->route('zones.index')->with('success', 'Zone ajoutée avec succès.');
        }
  
  
            // Afficher le formulaire de modification
      public function edit(Zone $zone) {
                return view('admin.zones.edit', compact('zone'));
            }
        
            // Mettre à jour une zone
            public function update(Request $request, Zone $zone) {
                // Validation des données
                $request->validate([
                    'nom' => 'required|string|max:255',
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric',
                    'coordinates' => 'required|string',
                    'city' => 'nullable|string|max:255',
                    'country' => 'nullable|string|max:255',
                ]);
        
                // Mise à jour de la Zone
                $zone->update([
                    'nom' => $request->nom,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'coordinates' => $request->coordinates,
                    'city' => $request->city,
                    'country' => $request->country,
                ]);
        
                return redirect()->route('zones.index')->with('success', 'Zone mise à jour avec succès.');
            }
       
        

    public function destroy(Zone $zone) {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone supprimée avec succès.');
    }
}
