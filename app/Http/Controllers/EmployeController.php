<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class EmployeController extends Controller
{
    public function index(Request $request)
    {
        //check permission
        $this->authorize("employe_view");

        if ($request->ajax()) {
            $data = Employe::query()
                ->get();
            return Datatables::of($data)->addIndexColumn()
            ->setRowClass(fn ($row) => 'align-middle')
            ->addColumn('action', function ($row) {
                $td = '<td>';
                $td .= '<div class="d-flex">';
                     $td .= '<a href="' . route('employes.show', $row->id) . '" type="button" class="btn btn-sm  btn-primary waves-effect waves-light me-1">' . __('buttons.view') . '</a>';
                     $td .= '<a href="' . route('employes.edit', $row->id) . '" type="button" class="btn btn-sm  btn-info waves-effect waves-light me-1">' . __('buttons.edit') . '</a>';
                    $td .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-url="' . route('employes.destroy', $row->id). '"  class="btn btn-sm  btn-danger delete-btn">' . __('buttons.delete') . '</a>';
                $td .= "</div>";
                $td .= "</td>";
                return $td;
            })
            ->editColumn('created_at', fn ($row) => formatDate($row->created_at))
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('employes.index');
    }

    public function create()
    {
        //check permission
        $this->authorize("employe_add");

        return view('employes.create');
    }

    public function store(EmployeRequest $request)
    {
        //check permission
        $this->authorize("employe_add");

        try {
            $validated = $request->validated();
            Employe::create($validated);

            return redirect()->route('employes.index')->with([
                "message" =>  __('messages.success'),
                "icon" => "success",
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                "message" =>  $th->getMessage(),
                "icon" => "error",
            ]);
        }
    }

    public function show(Employe $employe)
    {
        //check permission
        $this->authorize("employe_view");

        return view('employes.show', compact("employe"));
    }

    public function edit(Employe $employe)
    {
        //check permission
        $this->authorize("employe_edit");
        
        return view('employes.edit', compact("employe"));
    }

    public function update(EmployeRequest $request, Employe $employe)
    {
        //check permission
        $this->authorize("employe_edit");

        try {
            $validated = $request->validated();
            $employe->update($validated);

            return redirect()->route('employes.index')->with([
                "message" =>  __('messages.update'),
                "icon" => "success",
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                "message" =>  $th->getMessage(),
                "icon" => "error",
            ]);
        }
    }
    
    public function destroy(Employe $employe)
    {
        //check permission
        $this->authorize("employe_delete");

        $employe->delete();
        return redirect()->route('employes.index');
    }

    public function export()
    {
        //check permission
        $this->authorize("employe_export");

        // get the heading of your file from the table or you can created your own heading
        $table = "employes";
        $headers = Schema::getColumnListing($table);

        // query to get the data from the table
        $query = Employe::all();

        // create file name  
        $fileName = "employe_export_" .  date('Y-m-d_h:i_a') . ".xlsx";

        return Excel::download(new GeneralExport($query, $headers), $fileName);
    }

    public function import(Request $request)
    {
        //check permission
        $this->authorize("employe_import");

        //get file name from requets and find this file in the storage
        $filePath = storage_path('tmp/uploads/' . $request->file);

        // import to database
        Excel::import(new EmployesImport, $filePath);

        // delete temp file after uploading 
        unlink($filePath);

        return redirect()->route('employes.index')->with([
            "message" =>  __('messages.import'),
            "icon" => "success",
        ]);
    }
}