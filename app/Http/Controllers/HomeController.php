<?php

namespace App\Http\Controllers;
use App\Models\Estatus;
use App\Models\Roles;
use App\Services\ExpedienteService;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    protected $expedienteService;


    public function __construct(ExpedienteService $expedienteService)
    {
        $this->expedienteService = $expedienteService;
    }

    public  function index()
    {
        $estatus = Estatus::all();
        $user = Auth::user()->load('role');

    if ($user->role->id == 1) {
        $expedientes = $this->expedienteService->allFiles(5);
    } else {
        $expedientes = $this->expedienteService->userFiles(Auth::id(), 5);
    }

        return view('principal', compact('estatus', 'expedientes'));

    }



}
