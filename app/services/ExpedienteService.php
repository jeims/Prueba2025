<?php

namespace App\Services;

use App\Models\Expediente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ExpedienteService
{
    public function allFiles(int $porPagina = 10)
    {

         return Expediente::with(['estatus', 'usuario'])->paginate($porPagina);
    }

    public function userFiles(int $userId, int $porPagina = 10)
    {
        return Expediente::with(['estatus', 'usuario'])
            ->where('id_usuario_registra', $userId)
            ->paginate($porPagina);
    }



    public function create(array $data): Expediente
    {
        $data['id_usuario_registra'] = Auth::id();

        $añoActual = now()->year;
        $ultimo = Expediente::withTrashed()
            ->whereYear('created_at', $añoActual)
            ->orderBy('created_at', 'desc')
            ->first();


        if ($ultimo && preg_match('/(\d{5})\/' . $añoActual . '/', $ultimo->numero_expediente, $match)) {
            $siguienteNumero = intval($match[1]) + 1;
        } else {
            $siguienteNumero = 1;
        }


        $data['numero_expediente'] = str_pad($siguienteNumero, 5, '0', STR_PAD_LEFT) . '/' . $añoActual;


        return Expediente::create($data);
    }

    public function update (Expediente $expediente, array $data): Expediente
    {
        $expediente->update($data);
        return $expediente;
    }

    public function delete(Expediente $expediente): void
    {
        $expediente->delete();
    }

    public function seachFile($estatus = null, $fechaInicioDesde = null, $fechaInicioHasta = null, $busqueda = null)
    {
        $query = Expediente::query();

        if ($estatus) {
            $query->where('id_estatus', $estatus);
        }

        if ($fechaInicioDesde && $fechaInicioHasta) {
            $query->whereBetween('fecha_inicio', [Carbon::parse($fechaInicioDesde), Carbon::parse($fechaInicioHasta)]);
        }

        if ($busqueda) {
            $query->where(function($query) use ($busqueda) {
                $query->where('numero_expediente', 'like', "%$busqueda%")
                      ->orWhere('asunto', 'like', "%$busqueda%");
            });
        }

        return $query->paginate(5);
    }


}
