<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AirplaneController extends Controller
{
    protected $model = Airplane::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->model::all();
        return Inertia::render('Airplane/Index', [
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
        return Inertia::render('Airplane/Form');
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
            'airplane_model' => 'required|string',
            'seats' => 'required|integer',
            'special_seats' => 'required|integer',
        ]);

        try {
            $item = new $this->model();
            $item->airplane_model = $data['airplane_model'];
            $item->seats = $data['seats'];
            $item->special_seats = $data['special_seats'];
            $item->save();

            return redirect()->route('admin.avioes.index')->with('toast', json_encode([
                'title' => 'Sucesso!',
                'message' => 'Avião cadastrado com sucesso.',
                'type' => 'success'
            ]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao editar avião. Tente novamente',
                'type' => 'error'
            ]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->model::where('id', $id)->first();
        return Inertia::render('Airplane/Edit', [
            'item' => $item
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
        $item = $this->model::where('id', $id)->first();
        $data = $request->validate([
            'airplane_model' => 'required|string',
            'seats' => 'required|integer',
            'special_seats' => 'required|integer',
        ]);

        try {
            $item->airplane_model = $data['airplane_model'];
            $item->seats = $data['seats'];
            $item->special_seats = $data['special_seats'];
            $item->save();

        } catch (\Throwable $th) {
            return redirect()->back()->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao editar avião. Tente novamente',
                'type' => 'error'
            ]));
        }
        return redirect()->route('admin.avioes.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Avião editado com sucesso.',
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
        
        return redirect()->route('admin.avioes.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Avião excluído com sucesso.',
            'type' => 'success'
        ]));
    }
}
