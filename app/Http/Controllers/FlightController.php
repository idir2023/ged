<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RyanairService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Flight;
use App\Models\Billet;
use App\Models\Voyager;


//pdf facade for generating pdf
use Barryvdh\DomPDF\Facade\Pdf;


class FlightController extends Controller
{
    protected $ryanairService;

    public function __construct(RyanairService $ryanairService)
    {
        $this->ryanairService = $ryanairService;
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'departure' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'voyageurs' => 'required|integer|min:1|max:6',
        ]);


        // dd($validated);

        $flights = $this->ryanairService->getFlights(
            $validated['departure'],
            $validated['destination'],
            $validated['departure_date'],
            $validated['return_date'],
            $validated['voyageurs']
        );
        // dd($flights);

        // \Log::info($flights);
        return view('client.vols', ["flights" => $flights, 'voyageurs' => $validated['voyageurs']]);
    }

    public function checkout(Request $request)
    {

        $validated = $request->validate([
            'aller' => 'required|string',
            'retour' => 'required|string',
        ]);

        $allerValues = explode('|', $validated['aller']);
        $retourValues = explode('|', $validated['retour']);

        $flight_detail = [
            'aller' => [
                'origin' => $allerValues[0],
                'destination' => $allerValues[1],
                'flightNumber' => $allerValues[2],
                'dateOut' => Carbon::parse($allerValues[3])->locale('fr')->isoFormat('ddd D MMM'),
                'dateIn' => Carbon::parse($allerValues[4])->locale('fr')->isoFormat('ddd D MMM'),
                'hourOut' => Carbon::parse($allerValues[3])->format('H:i'),
                'hourIn' => Carbon::parse($allerValues[4])->format('H:i'),
                'duration' => Carbon::parse($allerValues[5])->format('G \h i \m\i\n'),
                'price' => $allerValues[6],
                'class' => $allerValues[7],
            ],
            'retour' => [
                'origin' => $retourValues[0],
                'destination' => $retourValues[1],
                'flightNumber' => $retourValues[2],
                'dateOut' => Carbon::parse($retourValues[3])->locale('fr')->isoFormat('ddd D MMM'),
                'dateIn' => Carbon::parse($retourValues[4])->locale('fr')->isoFormat('ddd D MMM'),
                'hourOut' => Carbon::parse($retourValues[3])->format('H:i'),
                'hourIn' => Carbon::parse($retourValues[4])->format('H:i'),
                'duration' => Carbon::parse($allerValues[5])->format('G \h i \m\i\n'),
                'price' => $retourValues[6],
                'class' => $retourValues[7],
            ]
        ];

        // dd($request->input());

        // $pdf = Pdf::loadView('client.checkout', ['flightDetails' => $flight_detail]);
        // return $pdf->stream('billet.pdf');
        return view('client.checkout', ['flightDetails' => $flight_detail, 'voyageurs' => $request->input('voyageurs')]);
    }


    public function getBillet(Request $request)
    {
        // dd($request->input());
        $validated = $request->validate([
            'voyageurs.*.nom' => 'required',
            'voyageurs.*.prenom' => 'required',
            'voyageurs.*.email' => 'required|email',
            'voyageurs.*.telephone' => 'required',
            'voyageurs.*.dateNais' => 'required|date',
            'flightDetails' => 'required',
        ]);

        // Decode flight details
        $validated['flightDetails'] = json_decode($validated['flightDetails'], true);

        // Generate a unique flight series (for all voyageurs)
        $validated['serie_billet'] = Str::upper(Str::random(4)) . time();


        // strore the first passenger in billet table
        $billet = new Billet();
        $billet->nom = $validated['voyageurs'][1]['nom'];
        $billet->prenom = $validated['voyageurs'][1]['prenom'];
        $billet->email = $validated['voyageurs'][1]['email'];
        $billet->telephone = $validated['voyageurs'][1]['telephone'];
        $billet->dateNais = $validated['voyageurs'][1]['dateNais'];
        $billet->serie = $validated['serie_billet'];  // Associate with the flight
        $billet->save();

        // Store flight details (same for all voyageurs)
        $flight = new Flight();
        $flight->serie = $validated['serie_billet'];

        $flight->allerorigin = $validated['flightDetails']['aller']['origin'];
        $flight->allerdestination = $validated['flightDetails']['aller']['destination'];
        $flight->allerflight_number = $validated['flightDetails']['aller']['flightNumber'];
        $flight->allerdate_out = $validated['flightDetails']['aller']['dateOut'];
        $flight->allerdate_in = $validated['flightDetails']['aller']['dateIn'];
        $flight->allerhour_out = $validated['flightDetails']['aller']['hourOut'];
        $flight->allerhour_in = $validated['flightDetails']['aller']['hourIn'];
        $flight->allerduration = $validated['flightDetails']['aller']['duration'];
        $flight->allerprice = $validated['flightDetails']['aller']['price'];
        $flight->allerclass = $validated['flightDetails']['aller']['class'];

        $flight->retourorigin = $validated['flightDetails']['retour']['origin'];
        $flight->retourdestination = $validated['flightDetails']['retour']['destination'];
        $flight->retourflight_number = $validated['flightDetails']['retour']['flightNumber'];
        $flight->retourdate_out = $validated['flightDetails']['retour']['dateOut'];
        $flight->retourdate_in = $validated['flightDetails']['retour']['dateIn'];
        $flight->retourhour_out = $validated['flightDetails']['retour']['hourOut'];
        $flight->retourhour_in = $validated['flightDetails']['retour']['hourIn'];
        $flight->retourduration = $validated['flightDetails']['retour']['duration'];
        $flight->retourprice = $validated['flightDetails']['retour']['price'];
        $flight->retourclass = $validated['flightDetails']['retour']['class'];

        $flight->save();

        // store the others in the voyagers table
        for ($i = 2; $i <= count($validated['voyageurs']); $i++) {
            $voyager = new Voyager();
            $voyager->nom = $validated['voyageurs'][$i]['nom'];
            $voyager->prenom = $validated['voyageurs'][$i]['prenom'];
            $voyager->email = $validated['voyageurs'][$i]['email'];
            $voyager->telephone = $validated['voyageurs'][$i]['telephone'];
            $voyager->dateNais = $validated['voyageurs'][$i]['dateNais'];
            $voyager->serie = $validated['serie_billet'];  // Associate with the flight
            $voyager->save();
        }

        // Generate and return PDF
        $pdf = Pdf::loadView('client.layout.billet', ['data' => $validated]);
        return $pdf->stream('billet.pdf');

        // // return view('client.layout.billet', ['data' => $validated]);
    }




}
