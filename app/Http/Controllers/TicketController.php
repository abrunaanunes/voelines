<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Passenger::whereHas('flights')->get();

        return Inertia::render('Ticket/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flights = Flight::whereDate('departure_date', '>', now())->get();
        return Inertia::render('Ticket/Form', [
            'flights' => $flights 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'document' => 'required|string',
                'birth' => 'required|string',
                'flight_id' => 'required|integer',
                'type_seat' => 'required|string',
            ]);
    
            $passenger = new Passenger();
            $passenger->name = $data['name'];
            $passenger->document = $data['document'];
            $passenger->birth = $data['birth'];
            $passenger->save();

            $passenger->flights()->attach($data['flight_id']);
    
            $flight = Flight::where('id', $data['flight_id'])->first();
            $seats = json_decode($flight->seats, true);
            $special_seats = json_decode($flight->special_seats, true);
            switch($data['type_seat']) {
                case 'special_seat': 
                    if($special_seats['original_number'] > $special_seats['reserveds']){
                        $flight->special_seats = json_encode([
                            'original_number' => $special_seats['original_number'],
                            'reserveds' => $special_seats['reserveds'] + 1
                        ]);
                        $flight->save();
                    }
                break;
                case 'seat':
                    if($seats['original_number'] > $seats['reserveds']){
                        $flight->seats = json_encode([
                            'original_number' => $seats['original_number'],
                            'reserveds' => $seats['reserveds'] + 1
                        ]);
                        $flight->save();
                    }
                break;
            }
            $flight->save();
            return redirect()->route('admin.passagens.index')->with('toast', json_encode([
                'title' => 'Sucesso!',
                'message' => 'Passagem reservada com sucesso.',
                'type' => 'success'
            ]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao tentar reservar passagem. Tente novamente.',
                'type' => 'error'
            ]));
        }
    }
}
