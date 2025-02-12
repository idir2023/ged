<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Visa;
use App\Models\Actualite;
use App\Models\Consultation;
use App\Models\Contact;
use App\Models\Review;
use App\Models\ApplyForm;
use App\Models\Assurance;
use Illuminate\Http\Request;


    class DashboardController extends Controller
    {
        public function index()
        {
            // Fetch data from the database
            $visas = Visa::all(); // Fetch all Visa records
            $count=  $visas->count();
         
            
         
    
            // Pass data to the view
            return view('admin.index', compact('count'));
        }
    }
    
    
    
    