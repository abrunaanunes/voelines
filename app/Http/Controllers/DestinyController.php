<?php

namespace App\Http\Controllers;

use App\Models\Destiny;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DestinyController extends Controller
{
    protected $model = Destiny::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->model::all();
        return Inertia::render('Destiny/Index', [
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
        return Inertia::render('Destiny/Form');
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
            'airport_cod' => 'required|string',
            'airport_name' => 'required|string',
            'shipping_fee' => 'required|regex:/^\d+(\.\d{1,2})?$/' // Convert to double
        ]);

        try {
            $destiny = new $this->model();

            $destiny->airport_cod = $data['airport_cod'];
            $destiny->airport_name = $data['airport_name'];
            $destiny->shipping_fee = $data['shipping_fee'];
            $destiny->save();

            return redirect()->route('admin.destinos.index')->with('toast', json_encode([
                'title' => 'Sucesso!',
                'message' => 'Destino cadastrado com sucesso.',
                'type' => 'success'
            ]));
        } catch (\Throwable $e) {
            return redirect()->back()->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao cadastrar destino. Tente novamente.',
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
        $item = $this->model::find($id);
        return Inertia::render('Destiny/Form', [
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
        $data = $request->validate([
            'airport_cod' => 'required|string',
            'airport_name' => 'required|string',
            'shipping_fee' => 'required|regex:/^\d+(\.\d{1,2})?$/' // Convert to double
        ]);

        try {
            $destiny = $this->model::find($id);

            $destiny->airport_cod = $data['airport_cod'];
            $destiny->airport_name = $data['airport_name'];
            $destiny->shipping_fee = $data['shipping_fee'];
            $destiny->save();

            return redirect()->route('admin.destinos.index')->with('toast', json_encode([
                'title' => 'Sucesso!',
                'message' => 'Destino editado com sucesso.',
                'type' => 'success'
            ]));
        } catch (\Throwable $e) {
            return redirect()->back()->with('toast', json_encode([
                'title' => 'Oops!',
                'message' => 'Erro ao editar destino. Tente novamente',
                'type' => 'error'
            ]));
        }
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
        
        return redirect()->route('admin.destinos.index')->with('toast', json_encode([
            'title' => 'Sucesso!',
            'message' => 'Destino excluído com sucesso.',
            'type' => 'success'
        ]));
    }
}
