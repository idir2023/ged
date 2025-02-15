<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Zone;


class ZoneController extends Controller
{
       /**
     * Affiche la liste des zones avec DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $zones = Zone::select(['id', 'nom', 'latitude', 'longitude']);
            return DataTables::of($zones)
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
        return view('admin.zones.create');
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
        ]);

        Zone::create($request->all());

        return redirect()->route('zones.index')->with('success', 'Zone ajoutée avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'une zone.
     */
    public function edit(Zone $zone)
    {
        return view('admin.zones.edit', compact('zone'));
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
