<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Estatus;
use Illuminate\Http\Request;
use App\Services\ExpedienteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ExpedienteController extends Controller
{
    protected $expedienteService;


    public function __construct(ExpedienteService $expedienteService)
    {
        $this->expedienteService = $expedienteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**


     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validate =  $request->validate([
            'asunto' => 'required|max:60',
            'fecha_inicio' => 'required',
        ]);

        $datos = $request->all();

        $this->expedienteService->create($datos);

        return redirect()->route('home.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'asunto_update' => 'required|max:60',
            'fecha_inicio_update' => 'required',
        ]);

        $datos = $request->all();

          $id = $datos['expediente_id'];

          $expediente = Expediente::findOrFail($id);


          $data = [
              'asunto' => $request->input('asunto_update'),
              'fecha_inicio' => $request->input('fecha_inicio_update'),
              'id_estatus' => $request->input('id_estatus'),
          ];

          $this->expedienteService->update($expediente, $data);

          return redirect()->back()->with('success', 'Expediente actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
          $expediente = Expediente::findOrFail($id);

          $expediente->delete();

          return redirect()->back();
    }

    public function show(Request $request)
    {

        $request->validate([
            'estatus' => 'nullable|exists:estatus,id',
            'fecha_inicio_desde' => 'nullable|date',
            'fecha_inicio_hasta' => 'nullable|date',
            'busqueda' => 'nullable|string|max:255',
        ]);


        $estatus = $request->input('estatus');
        $fechaInicioDesde = $request->input('fecha_inicio_desde');
        $fechaInicioHasta = $request->input('fecha_inicio_hasta');
        $busqueda = $request->input('busqueda');


        $expedientes = $this->expedienteService->seachFile(
            $estatus,
            $fechaInicioDesde,
            $fechaInicioHasta,
            $busqueda
        );


        $estatus = Estatus::all();


        return view('principal', compact('estatus', 'expedientes'));
    }


}
