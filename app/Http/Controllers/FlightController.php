<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use App\Models\Destiny;
use App\Models\Flight;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FlightController extends Controller
{
    protected $model = Flight::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->model::all();
        return Inertia::render('Flight/Index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $airplanes = Airplane::all();
        $destinies = Destiny::all();
        return Inertia::render('Flight/Form', [
            'airplanes' => $airplanes,
            'destinies' => $destinies,
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
        $data = $request->validate([
            'departure_date' => 'required|date',
            'value' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Convert to double
            'airplane_id' => 'required|integer', 
            'destiny_id' => 'required|integer',
        ]);

        try {
            $flight = new $this->model();

            $flight->departure_date = $data['departure_date'];
            $flight->value = $data['value'];
            $flight->airplane_id = $data['airplane_id'];
            $flight->destiny_id = $data['destiny_id'];
            $flight->save();

            $flight->special_seats = json_encode([
                "original_number" => $flight->airplane->special_seats,
                "reserveds" => 0
            ]);

            $flight->seats = json_encode([
                "original_number" => $flight->airplane->seats,
                "reserveds" => 0
            ]);

            $flight->save();

        } catch (\Throwable $e) {
            return redirect()->route('admin.voos.index')->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao cadastrar voo. Tente novamente.',
                'type' => 'error'
            ]));
        }
        return redirect()->route('admin.voos.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Voo cadastrado com sucesso.',
            'type' => 'success'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airplanes = Airplane::all();
        $destinies = Destiny::all();
        $item = $this->model::find($id);
    
        return Inertia::render('Flight/Form', [
            'item' => $item,
            'airplanes' => $airplanes,
            'destinies' => $destinies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'departure_date' => 'required|date',
            'value' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Convert to double
            'airplane_id' => 'required|integer', 
            'destiny_id' => 'required|integer',
        ]);

        $flight = $this->model::find($id);
       
        try {
            $flight->departure_date = $data['departure_date'];
            $flight->value = $data['value'];
            $flight->airplane_id = $data['airplane_id'];
            $flight->destiny_id = $data['destiny_id'];
            $flight->save();

            $flight->special_seats = json_encode([
                "original_number" => $flight->airplane()->special_seats,
                "reserveds" => 0
            ]);

            $flight->seats = json_encode([
                "original_number" => $flight->airplane()->seats,
                "reserveds" => 0
            ]);

            $flight->save();

        } catch (\Throwable $e) {
            return redirect()->route('admin.voos.index')->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao editar voo. Tente novamente.',
                'type' => 'error'
            ]));
        }
        return redirect()->route('admin.voos.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Voo editado com sucesso.',
            'type' => 'success'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        
        return redirect()->route('admin.voos.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Voo excluído com sucesso.',
            'type' => 'success'
        ]));
    }
}
