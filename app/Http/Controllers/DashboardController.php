<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use App\Models\Destiny;
use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $destinies = Destiny::count();
        $airplanes = Airplane::count();
        $passengers = Passenger::whereHas('flights', function($query) {
            $query->whereMonth('departure_date', now()->month);
        })->count();
        $flights = Flight::whereMonth('departure_date', now()->month)->count();

        return Inertia::render('Dashboard',[
            'destinies' => $destinies,
            'airplanes' => $airplanes,
            'passengers' => $passengers,
            'flights' => $flights
        ]);
    }
}
